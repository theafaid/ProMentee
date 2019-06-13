<?php


namespace App\Cacheable;

use Illuminate\Support\Facades\Cache;

class CacheableUsersRelations
{
    /**
     * Fetch user fields from caching according to it's type
     * @param null $type
     * @param null $user
     * @return mixed
     */
    public function fieldsIds($type = null, $user =null){
        $user = $user ?: auth()->user();

        if($type){
            return Cache::get("user.{$user->id}.{$type}Fields");
        }else{
            return array_merge(
                Cache::get("user.{$user->id}.eduFields"),
                Cache::get("user.{$user->id}.entmtFields")
            );
        }
    }
}
