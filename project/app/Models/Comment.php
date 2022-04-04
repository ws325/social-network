<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function getTimeAttribute()
    {
        if ($this->created_at->diffInDays() > 1) {
            return $this->created_at->toFormattedDateString();
        } else {
            return $this->created_at->diffForHumans();
        }
    }

    public function getFulltimeAttribute()
    {
        return $this->created_at->format('g:i | a d M Y');
    }
}
