<?php

namespace App\Http\Middleware;

use Closure;

class Confirmed
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
        if (Auth::user()->hasRole('confirmed')) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unconfirmed user.', 401);
            } else {
                return redirect()->guest('login');
            }
        }


        return $next($request);
    }
}
