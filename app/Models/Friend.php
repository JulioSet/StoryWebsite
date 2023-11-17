<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    use HasFactory;
    protected $table = "friend";
    public $timestamps = false;

    public function fromUser()
    {
        return $this->belongsTo(User::class, 'id_user_1', 'id');
    }
}
