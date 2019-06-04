<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'user_id', 'gender', 'yob', 'pic', 'motto', 'bio',
        'job', 'description', 'points'
    ];
}
