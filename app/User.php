<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @param $value
     * @return string
     */
    public function setUsernameAttribute($value){
        if($this->usernameExists($value)){
            $value = $value . rand(0, 99999);
        }

        return $this->attributes['username'] = $value;
    }

    /**
     * Check if the username is exists in database
     * @param $username
     * @return mixed
     */
    protected function usernameExists($username){
        return static::whereUsername($username)->exists();
    }
}
