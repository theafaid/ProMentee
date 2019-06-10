<?php


namespace App\Eloquent;


class EloquentUserRelations
{
    /**
     * Fetch user fields according to it's type
     * @param null $type
     * @param null $user
     * @return mixed
     */
    public function fieldsIds($type = null, $user){
        return $user->fields($type)->get()->pluck('id');
    }
}
