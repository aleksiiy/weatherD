<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSettings extends Model
{
    protected $table = 'usersettings';
    protected $guarded = ['id'];

    protected $casts = [
        'categories' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
