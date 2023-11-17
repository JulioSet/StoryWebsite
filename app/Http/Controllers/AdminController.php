<?php

namespace App\Http\Controllers;

use App\Models\Feed;
use App\Models\Transaction;
use App\Models\User;
use App\Rules\RegisterRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    // VIEW
    public function getUsers() {
        if (Session::has('userLoggedIn')) {
            $user = Session::get('userLoggedIn');
            if ($this->search_($user, 'username') != 'admin') {
                return redirect()->route('isLogged');
            }
        }
        else {
            return redirect('/login');
        }

        $listUser = User::all();
        return view('admin.users', ['listUser' => $listUser]);
    }

    public function getFeeds() {
        if (Session::has('userLoggedIn')) {
            $user = Session::get('userLoggedIn');
            if ($this->search_($user, 'username') != 'admin') {
                return redirect()->route('isLogged');
            }
        }
        else {
            return redirect('/login');
        }

        $listFeed = Feed::all();
        return view('admin.feeds', ['listFeed' => $listFeed]);
    }

    public function getTransaction()
    {
        $temp = Transaction::all()->sortDesc();
        $user = User::all();
        $transaction = array();
        $total = Transaction::sum('total');
        foreach ($temp as $t) {
            $fetch = [
                'id_user' => $t->id_user,
                'username' => $this->search_($t->id_user, 'username'),
                'created_at' => $t->created_at,
                'total' => $t->total
            ];
            $transaction[] = $fetch;
        }
        return view('admin.transaction', compact('transaction', 'total'));
    }

    // DB
    public function search_($id, $header) {
        $data = User::find($id)->$header;
        return $data;
    }

    // PROCESSING REQUEST
    public function editUser(Request $request) {
        $listUser = User::all();
        $rules = [];

        if ($this->search_($request->id, 'username') == $request->username) {
            $rules = [
                'description' => 'required|max:100',
                'title' => 'required|max:20'
            ];
        } else {
            $rules = [
                'username' => ['required', new RegisterRule($listUser)],
                'description' => 'required|max:100',
                'title' => 'required|max:20'
            ];
        }
        $messages = [
            "required" => "Tidak Boleh Kosong!",
            "max" => "Terlalu panjang"
        ];
        $request->validate($rules, $messages);

        $user = User::find($request->id);
        $user->username = $request->username;
        $user->title = $request->title;
        $user->description = $request->description;
        $user->save();

        return redirect('/admin/users');
    }

    public function editFeed(Request $request) {
        $rules = [
            'title' => 'required|min:10',
            'description' => 'required|min:10',
        ];
        $messages = [
            "required" => "Masih kosong!",
            "min" => "Terlalu pendek"
        ];
        $request->validate($rules, $messages);

        $feed = Feed::find($request->id);
        $feed->title = $request->title;
        $feed->description = $request->description;
        $feed->save();

        return redirect('/admin/feeds');
    }
}
