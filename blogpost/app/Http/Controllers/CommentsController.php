<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    function addcomment(Request $req, $id)
    {
        Comment::create([
            'comment' => $req->comment,
            'posts_id' =>$id,
            'users_id' => Auth::user()->id,
        ]);
        return redirect()->back();
    }

    // function showcomment($id)
    // {
    //     $postdetails = Post::all();
    //     $comment = Comment::where('post_id',$id);
    //     // return view('postdetails', compact('comment'));
    //     return dd($comment);
    // }
}
