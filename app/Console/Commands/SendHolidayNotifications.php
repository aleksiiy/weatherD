<?php

namespace App\Console\Commands;

use App\Jobs\SendNotificationOfHolidays;
use App\Models\Holiday;
use App\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection;

class SendHolidayNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:holidays';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send push notifications for holidays to users';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $now = Carbon::now('Asia/Almaty');
        $now->minute(0)->second(0);
        $tomorrow = Carbon::tomorrow('Asia/Almaty');
        $difference = $now->diffInHours($tomorrow);

        if (!in_array($difference, [1, 3, 6, 12, 24])) {
            return;
        }
        $notifyDay = $tomorrow->year(1970)->format('Y-m-d');
        $events = Holiday::where('date', $notifyDay)->where('floating', '=', 0)->get();
        $users = User::join('usersettings', 'usersettings.user_id', '=', 'users.id')
            ->where('usersettings.active', true)
            ->whereNotNull('users.push_token')
            ->orderBy('usersettings.time', 'DESC')
            ->select('users.*')
            ->get();
        if (count($users) == 0) {
            return;
        }
        foreach ($users as $user) {
            $settings = $user->settings;
            if ($now->addHours($settings->time) !== Carbon::tomorrow()) {
                continue;
            }
            $userCategories = $settings->categories;
            $adminEvents = new Collection();
            $privateEvents = new Collection();
            if (count($userCategories) > 0) {
                $categoryEvents = $events->whereIn('category_id', $userCategories);
                $adminEvents = $adminEvents->merge($categoryEvents);
            }
            if ($settings->favorite) {
                $favoriteEvents = $user->favorites()->where('date', $notifyDay)->get();
                $adminEvents = $adminEvents->merge($favoriteEvents);
            }
            if ($settings->private) {
                $privateEvents = $user->holidays()->where('date', $notifyDay)->get();
            }
            $notifyEvents = [
                'holidays'        => $adminEvents,
                'privateHolidays' => $privateEvents
            ];
            dispatch(new SendNotificationOfHolidays($user, $notifyEvents));
        }

    }
}
