<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use App\Rules\LoginRule;
use App\Rules\PasswordRule;
use App\Rules\RegisterRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use function PHPUnit\Framework\isNull;

class PageController extends Controller
{
    // VIEWER
    public function getHome() {
        $memberState = User::find(Session::get('userLoggedIn'))->membership ?? 0;
        return view('home', ['state' => $memberState]);
    }

    public function getAbout() {
        return view('about');
    }

    public function getLogin() {
        return view('login');
    }

    public function getRegister() {
        return view('register');
    }

    public function getProfile() {
        $user = User::find(Session::get('userLoggedIn'));
        return view('profile', [
            'user' => $user
        ]);
    }

    public function getTopup() {
        return view('topup');
    }

    // DB
    public function search_($id, $header) {
        $data = User::find($id)->$header;
        return $data;
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

    // REQUEST PROCESSING
    public function login(Request $request) {
        $user = User::all();

        $rules = [
            'username' => ['required', new LoginRule($user, $request->password, $request->username)],
            'password' => 'required'
        ];
        $messages = [
            "required" => "Masih kosong!"
        ];
        $request->validate($rules, $messages);

        $auth = User::where('username', $request->username)->first();
        Session::put('userLoggedIn', $auth->id);

        // ADMIN
        if ($this->search_(Session::get('userLoggedIn'), 'username') == 'admin') {
            Session::put('login_role', 'admin');
            return redirect('/admin/users');
        }
        // USER
        if ($request->rememberme) {
            Session::put('rememberMe', $user[0]->id);
        }
        $this->update_saldo();
        $this->set_profile();
        Session::put('login_role', 'user');

        return redirect()->route('isLogged');
    }

    public function logout() {
        Session::forget('userLoggedIn');
        Session::forget('rememberMe');
        Session::forget('profile');
        Session::forget('login_role');
        return redirect()->route("login");
    }

    public function register(Request $request) {
        $listUser = User::all('username');

        $rules = [
            'username' => ['required', new RegisterRule($listUser)],
            'email' => 'required',
            'password' => ['required', 'confirmed'],
            'password_confirmation' => 'required',
            'bod' => 'required',
            'description' => ['required', 'max:100'],
            'title' => 'required|max:100',
            'gender' => 'required'
        ];
        $messages = [
            "required" => "Masih kosong!",
            "max" => "Terlalu panjang",
            "confirmed" => ":attribute harus sama dengan confirmed password"
        ];
        $request->validate($rules, $messages);

        $user = new User();
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->gender = $request->gender;
        $user->bod = $request->bod;
        $user->title = $request->title;
        $user->description = $request->description;
        $user->save();

        return redirect('/login');
    }

    public function editProfile(Request $request) {
        $listUser = User::all('username');
        $islogged = $this->search_(Session::get('userLoggedIn'), 'username');
        $id_edit = Session::get('userLoggedIn');

        if ($islogged == $request->username) {
            $rules = [
                'username' => 'required',
                'email' => 'required',
                'old_password' => 'required',
                'password' => ['required', 'confirmed'],
                'password_confirmation' => 'required',
                'bod' => 'required',
                'description' => ['required', 'max:100'],
                'title' => 'required|max:100',
                'gender' => 'required',
                'photo' => 'required|mimes:gif,jpg,jpeg|max:3120'
            ];
        } else {
            $rules = [
                'username' => ['required', new RegisterRule($listUser)],
                'email' => 'required',
                'old_password' => ['required', new PasswordRule($this->search_($id_edit, 'password'))],
                'password' => ['required', 'confirmed'],
                'password_confirmation' => 'required',
                'bod' => 'required',
                'description' => ['required', 'max:100'],
                'title' => 'required|max:100',
                'gender' => 'required',
                'photo' => 'required|mimes:gif,jpg,jpeg|max:3000'
            ];
        }

        $messages = [
            "required" => "Masih kosong!",
            "max" => "Terlalu panjang",
            "confirmed" => ":attribute harus sama dengan confirmed password",
            "mimes" => ":attribute harus dalam bentuk .jpg, .jpeg, atau .gif",
            "photo.max" => ":attribute terlalu besar ukurannya"
        ];
        $request->validate($rules, $messages);

        // UPLOAD FOTO
        $photo = $request->file('photo');
        $namaFilePhoto  = time().".".$photo->getClientOriginalExtension();
        $namaFolderPhoto = "photo/";
        $photo->storeAs($namaFolderPhoto,$namaFilePhoto, 'public');

        $user = User::find(Session::get('userLoggedIn'));
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->gender = $request->gender;
        $user->bod = $request->bod;
        $user->title = $request->title;
        $user->description = $request->description;
        $user->pict = $namaFilePhoto;
        $user->save();

        Session::forget('profile');
        Session::put('profile', $user->pict);

        return redirect('/profile');
    }

    public function buyMembership() {
        $user = User::find(Session::get('userLoggedIn'));
        if ($user->saldo < 5000) {
            return redirect('/')->with('msg', 'nope');
        }
        $user->saldo -= 5000;
        $user->membership = 1;
        $user->save();

        $transaction = new Transaction();
        $transaction->id_user = Session::get('userLoggedIn');
        $transaction->save();

        $this->update_saldo();
        return redirect()->route('isLogged');
    }

    public function topup(Request $req) {
        $rules = [
            'topup' => 'required|numeric|min:1'
        ];
        $messages = [
            "required" => "Masih kosong!",
            "min" => "Harus diatas 0"
        ];
        $req->validate($rules, $messages);

        $user = User::find($req->id);
        $user->saldo += $req->topup;
        $user->save();

        $this->update_saldo();
        return redirect()->route('isLogged');
    }
}
