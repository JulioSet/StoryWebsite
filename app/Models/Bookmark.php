<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    use HasFactory;
    protected $table = "bookmark";
    public $timestamps = false;

    public function fromUser()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
