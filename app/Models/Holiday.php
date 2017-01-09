<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    protected $guarded = ['id'];

    protected $appends = ['image_url'];

    const IMAGE_FOLDER = '/uploads/holidays_admin/';
    const DEFAULT_YEAR = 1970;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function owner()
    {
        return $this->belongsTo('App\User');
    }

    public function users()
    {
        return $this->belongsToMany('App\User', 'holiday_user');
    }

    public function getImageUrlAttribute()
    {
        $path = $this->getAttribute('image') ? asset($this->getAttribute('image')) : null;
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
