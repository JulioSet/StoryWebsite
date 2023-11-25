<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class Lock
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Session::has('userLoggedIn')) {
            $user = User::find(Session::get('userLoggedIn'))->status;
            if ($user != 1) {
                Session::forget('userLoggedIn');
                Session::forget('rememberMe');
                Session::forget('profile');
                Session::forget('login_role');
                return redirect()->route("login")->with('msg', 'nope');
            }
        }
        return $next($request);
    }
}
