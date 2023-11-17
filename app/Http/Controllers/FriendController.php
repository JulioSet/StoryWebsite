<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FriendController extends Controller
{
    public function getAddfriend()
    {
        $listuser = User::where('id', '!=', Session::get('userLoggedIn'))->where('username', '!=', 'admin')->get();
        $listfriend = Friend::with('fromUser')->where('id_user_1','=', Session::get('userLoggedIn'))->get();
        $temp = array();
        foreach ($listuser as $u) {
            $status = 0;
            // Ngecek udah di add apa belum
            foreach ($listfriend as $f) {
                if ($u->id == $f->id_user_2) {
                    $status = 1;
                }
            }

            $fetch = [
                'id' => $u->id,
                'pict' => $u->pict,
                'username' => $u->username,
                'title' => $u->title,
                'status' => $status,
            ];
            $temp[] = $fetch;
        }
        return view('addfriend', [ 'listuser' => $temp ]);
    }

    public function getListfriend()
    {
        $listfriend = Friend::with('fromUser')->where('id_user_1','=', Session::get('userLoggedIn'))->get();
        $temp = array();
        foreach ($listfriend as $f) {
            if ($f->id_user_1 == Session::get('userLoggedIn')) {
                $temp[] = User::find($f->id_user_2);
            }
        }
        return view('listfriend', [ 'listfriend' => $temp ]);
    }

    public function add($id)
    {
        $friend = new Friend();
        $friend->id_user_1 = Session::get('userLoggedIn');
        $friend->id_user_2 = $id;
        $friend->save();

        $friend = new Friend();
        $friend->id_user_1 = $id;
        $friend->id_user_2 = Session::get('userLoggedIn');
        $friend->save();

        return redirect('/friend/add');
    }
}
