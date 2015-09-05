<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Contracts\Auth\Guard;

class Authenticate
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        \Log::error("apple" . Auth::check());
        if (Auth::check()) {

            return $next($request);

        } else {

            return $next($request);

            echo 'not login ';

            if ($request->is('auth/*') || $request->is('login') || $request->is('register') || $request->is('/')) {
                echo 'not login 1';

                return $next($request);

            }

            echo 'not login 2 ';
            return redirect('/');

        }
    }
}
