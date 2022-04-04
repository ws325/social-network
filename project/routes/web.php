<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;
use \App\Models\User;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if(request('search'))
    {
        if(str_contains(request('search'),'#'))
        {
            $posts=Post::withAnyTags([(request('search'))])->latest()->get();
        return view('posts.tags')->withPosts($posts);
        }
        $user=User::where('name','like',''.request('search').'%') -> first();
        if($user) return view('profile.index')->withUser($user);
    }
    return view('home');
})->middleware(['auth']);

Route::get('/dashboard', function () {
    return view('dashboardmod');
})->middleware(['moderator']);


require __DIR__.'/auth.php';

Route::get('profile/{user}', '\App\Http\Controllers\ProfileController@index') ->name('profile.show')->middleware(['auth']);

Route::resource('posts', \App\Http\Controllers\PostController::class)->middleware(['auth']);
Route::resource('posts.comments', \App\Http\Controllers\CommentController::class)->middleware(['auth']);
Route::resource('profile', \App\Http\Controllers\ProfileController::class)->middleware(['auth']);
Route::resource("profile.likes", \App\Http\Controllers\LikeController::class)->middleware(['auth']);
Route::resource("notifications", \App\Http\Controllers\NotificationController::class)->middleware(['auth']);

Route::get('hashtag/{tag}', '\App\Http\Controllers\PostController@postwithtags')->middleware(['auth']);

Route::get('/moderator', 'ModeratorController@index')->name('moderator')->middleware('moderator');
//Route::get('/dashboard','App\Http\Controllers\DashController@index')->middleware(['auth'])->name('dashboard');
Route::put('/moderator/ban{user}', 'App\Http\Controllers\ModeratorController@block')->name('moderator.users.ban')->middleware('moderator');
Route::put('/moderator/warn{user}', 'App\Http\Controllers\ModeratorController@warn')->name('moderator.users.warning')->middleware('moderator');
