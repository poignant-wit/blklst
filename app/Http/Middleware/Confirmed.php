<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Confirmed
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param null $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if ((!Auth::guard($guard)->guest()) && Auth::user()->confirmed == 0 ) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->route('home')->with('info', 'Ваш профиль неактивирован');
//                return view('welcome')->with('info', 'Ваш профиль неактивирован');
//                dd("ERROR");
            }
        }
        return $next($request);
    }
}
