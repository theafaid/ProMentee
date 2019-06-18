<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;

class User extends Authenticatable implements MustVerifyEmail
{

    use Notifiable;

    public static function boot(){
        parent::boot();

        static::created(function($user){
            \Cache::forever("user.{$user->id}.points", 0);
            // Create a profile for registered user
            $user->profile()->create([
                'yob'    => request('yob') ?: date('Y') - 10, // 10 years is default for unit testing
                'gender' => request('gender') ?: 'male' // male is default for unit testing
            ]);
        });
    }

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

        $value = $this->usernameExists($value) ? $value . substr(time(), 6, 4) : $value;

        $this->attributes['username'] = $value;
    }


//    /**
//     * @param $value
//     * @return string
//     */
//    public function getNameAttribute($value){
//        $prefix =  $this->profile->gender == 'male' ? 'Mr' : 'Mrs';
//
//        return "{$prefix} {$value}";
//    }
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

    /**
     * Get All or Specific Selected fields according to its type for a specific user
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function fields($type = null){
        $relation = $this->belongsToMany('App\Field', 'field_user', 'user_id', 'field_id');

        return ! $type ? $relation : $relation->where('type', $type);
    }

    /**
     * Set field for a user
     * @param $field
     */
    public function setField($field){
         $this->fields()->attach(['field_id' => $field->id]);
    }

    /**
     * Check if the user has set his fields or not
     * @return bool
     */
    public function hasSetFields($user = null){
        $user = $user ?: auth()->user() ?: $this;
        // if cache have eduFields it's means that it also have entmtFields
        return \Cache::has("user.{$user->id}.eduFields");
    }

    public function getLevel(){
        $points = \Cache::get("user.{$this->id}.points");

        if($points <= 0) return level('zero');
        elseif ($points > 0   && $points <= 50)   return level('one');
        elseif ($points > 50  && $points <= 150)  return level('two');
        elseif ($points > 150 && $points <= 300)  return level('three');
        elseif ($points > 300 && $points <= 450)  return level('four');
        elseif ($points > 450 && $points <= 700)  return level('five');
        elseif ($points > 700 && $points <= 1000) return level('sex');
        elseif ($points > 1000) return level('seven');
    }

}
