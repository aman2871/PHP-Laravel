<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;

class PostDetailsController extends Controller
{
    function postdetails($id)
    {
        $comment = Comment::where('posts_id', $id);
        $details = Post::find($id);
        return view('postdetails', ['post' => $details, 'commmentsdata' => $comment]);
        // return dd($comment);
    }
    
}
