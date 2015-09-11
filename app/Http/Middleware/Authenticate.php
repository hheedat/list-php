<?php

namespace listapp\Http\Middleware;

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
        if (Auth::check()) {

            \Log::info('login');

            if ($request->is('login') || $request->is('register') || $request->is('/')) {

                \Log::info('login and redirect');

                return redirect('/list');

            }

            return $next($request);

        } else {

            if ($request->is('auth/*') || $request->is('login') || $request->is('register') || $request->is('/')) {

                \Log::info('not login and pass');

                return $next($request);

            }

            \Log::info('not login and redirect');

            return redirect('/');

        }
    }
}
