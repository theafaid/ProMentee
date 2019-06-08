<?php


namespace App\Eloquent;


class EloquentUsers
{
    /**
     * Fetch user fields according to it's type
     * @param null $type
     * @param null $user
     * @return mixed
     */
    public function fields($type = null, $user = null){
        $user = $user ?: auth()->user();

        return $user->fields($type)->get();
    }
}
