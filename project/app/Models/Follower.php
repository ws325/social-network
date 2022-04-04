<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    use HasFactory;

    public $primaryKey = 'id';

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function notification(){
        return $this->belongsTo(Notification::class);
    }

}
