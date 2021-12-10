<?php

namespace App\Http\Middleware;

use Closure;

class Delivery_guyAuthenticate
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
        if (!auth()->guard('delivery_guy')->check()) {
            return redirect(route('delivery_guy.login'));
        }
        return $next($request);
    }
}
