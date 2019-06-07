<?php

namespace App\Http\Middleware;

use Closure;

class RedirectIfFieldsNotSet
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $action = 'login')
    {

        $user = auth()->user();

        if(! $user) return $action == 'login' ?  redirect(route('login')) : $next($request) ;

        return $user->hasSetFields() ? $next($request) : redirect(route('setFields'));
    }
}
