<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = ['id'];

    protected $appends = ['holidays_count'];

    public function holidays()
    {
        return $this->hasMany(Holiday::class);
    }

    public function getHolidaysCountAttribute()
    {
        return $this->holidays()->count();
    }
}
