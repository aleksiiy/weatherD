<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class PrivateHoliday extends Model
{
    protected $guarded = ['id'];
    protected $appends = ['image_url'];

    const IMAGE_FOLDER = '/uploads/holidays/';
    const DEFAULT_YEAR = 1970;

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function getImageUrlAttribute()
    {
        $path = $this->getAttribute('image') ? asset(self::IMAGE_FOLDER . $this->getAttribute('image')) : null;
        return $path;
    }

    public function getDateAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d', $date)->format('m-d');
    }

    public function setDateAttribute($date)
    {
        $currentYearDate = Carbon::createFromFormat('m-d', $date);
        $currentYearDate->year = self::DEFAULT_YEAR;
        $currentYearDate->format('Y-m-d');
        $this->attributes['date'] = $currentYearDate;
    }
}
