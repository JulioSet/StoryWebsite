<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use App\Models\Feed;
use App\Models\Like;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FeedController extends Controller
{
    // VIEW
    public function view() {
        $bookmark = Bookmark::with('fromUser')->where('id_user', '=', Session::get('userLoggedIn'))->get();
        $listlike = Like::with('fromUser')->where('id_user', '=', Session::get('userLoggedIn'))->get();
        $feed = Feed::all();
        $temp = array();
        foreach ($feed as $f) {
            $status = 0;
            $like = 0;
            foreach ($bookmark as $b) {
                if ($f->id == $b->id_feed) {
                    $status = 1;
                }
            }
            foreach ($listlike as $l) {
                if ($f->id == $l->id_feed) {
                    $like = 1;
                }
            }
            $fetch = [
                'id' => $f->id,
                'photo' => $f->photo,
                'title' => $f->title,
                'writer' => $f->writer,
                'date' => $f->date,
                'likes' => $f->likes,
                'duration' => $f->duration,
                'description' => $f->description,
                'content' => $f->content,
                'status' => $status,
                'like' => $like
            ];
            $temp[] = $fetch;
        }
        return view('story', ['listFeed' => $temp]);
    }

    public function getCreate() {
        return view('createstory');
    }

    public function getMyFeed() {
        $user = Session::get('userLoggedIn');
        $listFeed = Feed::with('fromUser')->where('writer', '=', $this->search_($user, 'username'))->get();
        return view('mystory', ['listFeed' => $listFeed]);
    }

    public function getDetail($id) {
        $ownership = Feed::find($id);
        $cekId = User::with('toFeed')->where('username', '=', $ownership->writer)->first();
        $auth = $cekId->id ?? 0;
        if ($auth == Session::get('userLoggedIn')) {
            $feed = Feed::find($id);
            return view('detailFeed', ['feed' => $feed]);
        }

        $state = User::find(Session::get('userLoggedIn'));
        if ($state->membership == 0) {
            return redirect('/feed')->with('msg', 'nope');
        }

        $feed = Feed::find($id);
        return view('detailFeed', ['feed' => $feed]);
    }

    public function getEdit($id) {
        $feed = Feed::find($id);
        return view('editFeed', ['feed' => $feed]);
    }

    public function getBookmark() {
        $bookmark = Bookmark::with('fromUser')->where('id_user', '=', Session::get('userLoggedIn'))->get();
        $feed = Feed::all();
        $temp = [];
        foreach ($bookmark as $b) {
            foreach ($feed as $f) {
                if ($b->id_feed == $f->id) {
                    $temp[] = $f;
                }
            }
        }
        return view('bookmark', [ 'listFeed' => $temp ]);
    }

    // DB
    public function search_($id, $header) {
        $data = User::find($id)->$header;
        return $data;
    }

    public function search_feed(Request $req)
    {
        $feed = Feed::where('writer', 'like', '%'.$req->search.'%')->orWhere('title', 'like', '%'.$req->search.'%')->get();
        return view('story', ['listFeed' => $feed->sortBy('likes')->sortDesc()]);
    }

    // PROCESSING REQUEST
    public function createFeed(Request $request) {
        $rules = [
            'photo' => 'required|mimes:gif,jpg,jpeg|max:3000',
            'title' => 'required|min:10',
            'duration' => 'required|numeric',
            'description' => 'required|min:10',
            'story' => 'required'
        ];
        $messages = [
            "required" => "Masih kosong!",
            "min" => "Terlalu pendek",
            "numeric" => "Harus angka!",
            "mimes" => ":attribute harus dalam bentuk .jpg, .jpeg, atau .gif",
            "photo.max" => ":attribute terlalu besar ukurannya"
        ];
        $request->validate($rules, $messages);

        // UPLOAD FOTO
        $photo = $request->file('photo');
        $namaFilePhoto  = time().".".$photo->getClientOriginalExtension();
        $namaFolderPhoto = "photo/";
        $photo->storeAs($namaFolderPhoto,$namaFilePhoto, 'public');

        $feed = new Feed();
        $feed->photo = $namaFilePhoto;
        $feed->title = $request->title;
        $feed->writer = $this->search_(Session::get('userLoggedIn'), 'username');
        $feed->date = date('d M Y');
        $feed->duration = $request->duration;
        $feed->description = $request->description;
        $feed->content = $request->story;
        $feed->save();

        return redirect('/feed');
    }

    public function editFeed(Request $request, $id) {
        $rules = [
            'photo' => 'required|mimes:gif,jpg,jpeg|max:3000',
            'title' => 'required|min:10',
            'duration' => 'required|numeric',
            'description' => 'required|min:10',
            'story' => 'required'
        ];
        $messages = [
            "required" => "Masih kosong!",
            "min" => "Terlalu pendek",
            "numeric" => "Harus angka!",
            "mimes" => ":attribute harus dalam bentuk .jpg, .jpeg, atau .gif",
            "photo.max" => ":attribute terlalu besar ukurannya"
        ];
        $request->validate($rules, $messages);

        // UPLOAD FOTO
        $photo = $request->file('photo');
        $namaFilePhoto  = time().".".$photo->getClientOriginalExtension();
        $namaFolderPhoto = "photo/";
        $photo->storeAs($namaFolderPhoto,$namaFilePhoto, 'public');

        $feed = Feed::find($id);
        $feed->photo = $namaFilePhoto;
        $feed->title = $request->title;
        $feed->duration = $request->duration;
        $feed->description = $request->description;
        $feed->content = $request->story;
        $feed->save();

        return redirect('/myfeeds');
    }

    public function bookmark($id) {
        $bookmark = new Bookmark();
        $bookmark->id_user = Session::get('userLoggedIn');
        $bookmark->id_feed = $id;
        $bookmark->save();
        return redirect('/feed');
    }

    public function like($id) {
        $like = new Like();
        $like->id_user = Session::get('userLoggedIn');
        $like->id_feed = $id;
        $like->save();

        $feed = Feed::find($id);
        $feed->likes += 1;
        $feed->save();
        return redirect('/feed');
    }
}
