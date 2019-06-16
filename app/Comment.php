<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['user_id', 'commentable_id', 'commentable_type', 'body'];
    protected $with = ['creator'];

    public function commentable(){
        return $this->morphTo();
    }

    public function creator(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
