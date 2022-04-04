<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('comments.index')->withComments(Comment::all());
    }

    public function store(Request $request, int $post_id)
    {
        $this->validate($request, [
            'comment' => 'required'
        ]);
        $comment = new Comment();
        $comment->text = $request->comment;
        $comment->user_id = Auth::user()->id;
        $comment->post_id = $post_id;
        $comment->save();
        header("Location:". $_SERVER['HTTP_REFERER']); //powrot na poprzednia strone
        exit;
    }

    public function show(Post $post,Comment $comment)
    {
        return view('comments.show')->withComment($comment);
    }

    public function destroy($post, $comment)
    {
        $comment = Comment::find($comment);
        $comment->delete();
        header("Location:". $_SERVER['HTTP_REFERER']); //powrot na poprzednia strone
        exit;
    }
}
