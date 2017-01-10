<?php

namespace App\Jobs;

use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Log;
use PushNotification;

class SendNotificationOfHolidays implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $user, $notifyEvents;

    /**
     * Create a new job instance.
     *
     * @param $user
     * @param $notifyEvents
     */
    public function __construct($user, $notifyEvents)
    {
        $this->user = $user;
        $this->notifyEvents = $notifyEvents;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $user = $this->user;
        $notifyEvents = $this->notifyEvents;

        $message = PushNotification::Message('Holidays are coming', [
            'notifyEvents' => $notifyEvents
        ]);
        PushNotification::app('kzHolidaysAndroid')
            ->to($user->push_token)
            ->send($message);
    }

    /**
     * The job failed to process.
     *
     * @param  Exception $exception
     *
     * @return void
     */
    public function failed(Exception $exception)
    {
        $user = $this->user;
        Log::error("User <$user->id> wasn't notified by push notification");
    }
}
