<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class RememberMe
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Session::has('userLoggedIn')) {
            if (Session::has('rememberMe')) {
                $user = Session::get('rememberMe');
                Session::put('userLoggedIn', $user);
                if ($this->search_($user, 'username') == 'admin') {
                    Session::put('login_role', 'admin');
                    return redirect('/admin/users');
                }
                else {
                    $this->update_saldo();
                    $this->set_profile();
                    Session::put('login_role', 'user');
                    return redirect('/feed');
                }
            }
        }

        return $next($request);
    }

    public function update_saldo() {
        $user = User::find(Session::get('userLoggedIn'));
        Session::put('saldo', $user->saldo);
    }

    public function set_profile()
    {
        $user = User::find(Session::get('userLoggedIn'));
        if ($user->pict != null) {
            Session::put('profile', $user->pict);
        }
    }

    public function search_($id, $header) {
        $data = User::find($id)->$header;
        return $data;
    }
}
