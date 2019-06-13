<?php

namespace App\Http\Middleware;

use Closure;

class RedirectIfFieldsSet
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        return ! auth()->user()->hasSetFields() ? $next($request) : abort(403);
    }
}
