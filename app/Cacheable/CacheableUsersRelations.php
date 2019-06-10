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
        $type = ! $type ? 'all' : $type;

        $user = $user ?: auth()->user();

        $key = "user.{$user->id}.{$type}Fields";

        dd(Cache::get($key));
        return Cache::get($key);
    }
}
