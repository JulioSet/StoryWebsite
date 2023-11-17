<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    protected $table = "user";
    public $timestamps = false;

    public function toFeed()
    {
        return $this->hasMany(Feed::class, 'writer', 'username');
    }

    public function toFriend()
    {
        return $this->hasMany(Friend::class, 'id_user_1', 'id');
    }

    public function toBookmark()
    {
        return $this->hasMany(Bookmark::class, 'id_user', 'id');
    }

    public function toLike()
    {
        return $this->hasMany(Like::class, 'id_user', 'id');
    }
}
