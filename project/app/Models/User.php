<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'nick'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function followers()
    {
        return $this->hasMany(Follower::class, 'user_id');
    }

    public function followings()
    {
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'follower_id')->withTimestamps();
    }

    public function getRecommendationAttribute(): array
    {
        $userFollowsId = DB::table('followers')
            ->where('follower_id', '=', Auth::user()->id)
            ->get('user_id')
            ->map(function ($item) {
                return $item->user_id;
            });

        $recommendationsId = DB::table('followers')
            ->whereIn('follower_id', $userFollowsId)
            ->where('user_id', '!=', Auth::user()->id)
            ->whereNotIn('user_id', $userFollowsId)
            ->get()
            ->groupBy('user_id')->map(function ($item) {
                return $item->count();
            })
            ->sortDesc()
            ->take(5);

        $final = array();
        foreach ($recommendationsId as $user_id => $mutual) {
            $user = DB::table('users')->where('id', $user_id)->get();
            array_push($final, ['user' => $user[0], 'mutuals' => $mutual]);
        }
        return $final;
    }

    public function getTrendAttribute(): array
    {
        #id hasztaga z liczba postow w ktorych wystepuje
        $countedHashtags = DB::table('taggables')
            ->get()
            ->groupBy('tag_id')->map(function ($item) {
                return $item->count();
            })
            ->sortDesc()
            ->take(9);

        $final = array();
        foreach ($countedHashtags as $hashtag_id => $posts_number) {
            $hashtag = DB::table('tags')->where('id', $hashtag_id)->first()->name;
            preg_match_all('/#(\w+)/', $hashtag, $match);

            array_push($final, ['hasztag' => substr($match[0][0], 1), 'posts_number' => $posts_number]);
        }
        return $final;

    }


    public function getFollowerspostsAttribute()
    {
        $ids = array();
        foreach ($this->followings as $follow) {
            array_push($ids, $follow->id);
        }

        array_push($ids, Auth::user()->id);
        return Post::whereIn('user_id', $ids)->latest()->get();

    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

}
