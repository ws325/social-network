<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Tags\HasTags;

class Post extends Model
{
    use HasFactory,HasTags;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
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

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function getTextwithtagAttribute()
    {
        $string=strip_tags($this->text);
        return preg_replace('/#([0-9a-zA-Z]+)/i', '<a href="/hashtag/$1">#$1</a>', $string);
    }
}
