<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    public static function boot(){
        parent::boot();

        static::created(function($user){
            // Update Username after register a new user
            // because we want a new instance from the user to use his id
            $user->update(['username' => ucfirst(Str::camel($user->name))]);

            // Create a profile for registered user
            $user->profile()->create([
                'yob'    => request('yob') ?: date('Y') - 10, // 10 years is default for unit testing
                'gender' => request('gender') ?: 'male' // male is default for unit testing
            ]);
        });
    }

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password', 'provider', 'provider_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
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
     */
    public function setUsernameAttribute($value){

        $value = $this->usernameExists($value) ? "{$value}{$this->id}" : $value;

        $this->attributes['username'] = $value;
    }

    /**
     * Check if the username is exists in database
     * @param $username
     * @return mixed
     */
    protected function usernameExists($username){
        return static::whereUsername($username)->exists();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function profile(){
        return $this->hasOne('App\Profile');
    }
}
