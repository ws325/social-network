<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function like(){
        return $this->belongsTo(Like::class);
    }

    public function follower(){
        return $this->belongsTo(Follower::class);
    }
    use HasFactory;
}
