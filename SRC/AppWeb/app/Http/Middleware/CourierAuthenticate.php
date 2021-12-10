<?php

namespace App\Http\Middleware;

use Closure;

class CourierAuthenticate
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
        if (!auth()->guard('courier')->check()) {
            return redirect(route('courier.login'));
        }
        return $next($request);
    }
}
