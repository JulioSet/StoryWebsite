<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class Access
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        if ($role == 'user') {
            if (Session::get('login_role') != $role) return redirect('admin/users');
        }
        else if ($role == 'admin') {
            if (Session::get('login_role') != $role) return redirect('');
        }
        else if ($role == 'guest') {
            if (Session::get('login_role') == 'user') return redirect('');
            if (Session::get('login_role') == 'admin') return redirect('admin/users');
        }

        return $next($request);
    }
}
