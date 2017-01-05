<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Carbon;

class User extends Authenticatable
{
    use Notifiable;
    use EntrustUserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'device_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function holidays() {
        return $this->hasMany('App\Models\PrivateHoliday');
    }

    public function favorites() {
        return $this->belongsToMany('App\Models\Holiday', 'holidays_users');
    }

    public function settings() {

        return $this->hasOne('App\Models\UserSettings');
    }

    public function getDateAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d', $date)->format('m-d');
    }

    public function setBalanceAttribute($date)
    {
        $currentYearDate = Carbon::createFromFormat('m-d', $date);
        $currentYearDate->year = 1970;
        $currentYearDate->format('Y-m-d');
        $this->attributes['date'] = $currentYearDate;
    }
}
