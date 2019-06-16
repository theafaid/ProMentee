<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'field_id', 'user_id', 'title', 'slug' , 'body', 'type'
    ];

    protected $with = ['field', 'favorites', 'user'];

    protected $appends = ['isFavorited'];

    public function getRouteKeyName()
    {
        return "slug";
    }

    /**
     * Get posts for current user
     * @param $type
     * @return mixed
     */
    public static function feed($type = null){

        $type = in_array($type, ['edu', 'entmt']) ? $type : null;

        $user = resolve('User');

        if($type){
            $userFields = $user->fieldsIds($type);
        }else{
            $userFields = array_merge($user->fieldsIds('edu'), $user->fieldsIds('entmt'));
        }

        return static::whereIn('field_id', $userFields)->latest()->get();
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function field(){
        return $this->belongsTo('App\Field');
    }

    public function favorites(){
        return $this->morphMany('App\Favorite', 'favorited');
    }

    public function getIsFavoritedAttribute(){
        return $this->favorites()->where('user_id', auth()->id())->exists();
    }

    public function comments(){
        return $this->morphMany('App\Comment', 'commentable');
    }

    public function createComment($body, $userId = null){
        return $this->comments()->create([
            'user_id' => $userId ?: auth()->id(),
            'body'    => $body
        ]);
    }
}
