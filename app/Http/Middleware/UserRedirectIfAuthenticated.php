<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class UserRedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {

        # check user is authencated
        if (Auth::check() && Auth::user()) {

            # user is online
            $expireTime = now()->addMinutes(2);

            # set to cache
            Cache::put('user-is-online-' . Auth::id(), true, $expireTime);

            # update last seen in database
            User::find(Auth::id())->update(['last_seen' => now()]);

            # redirect to next page
            return $next($request);
        } else {
            # redirect to login page
            return redirect()->route('login');
        }
    }
}
