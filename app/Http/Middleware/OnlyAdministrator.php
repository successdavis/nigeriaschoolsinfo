<?php

namespace App\Http\Middleware;

use Closure;

class OnlyAdministrator
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
        

        if (auth()->check() && auth()->user()->hasRole(['admin'])) {
            return $next($request);
        }
        abort(403, 'You do not have permission to perform this action');
    }
}
