<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Comment;
use App\Notifications\postnotify;
use App\Notifications\commentnotify;
use Notification;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Storage;
// use Illuminate\Support\Facades\Validator;
// use Symfony\Component\Finder\Finder;
// use Illuminate\Support\Facades\Mail;
// use Illuminate\Notifications\Notification;
// use Illuminate\Session\Store;
// use App\Models\User;
// use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        // return view('home');
        $tag = Tag::all();
        // $tagpost=Post::where('tags_id',$request->tag_name);
        $posts = Post::paginate(2);
        return view('home', compact('tag', 'posts'));
        // return dd($tagpost);
    }

    public function addtag(Request $req)
    {
        $tid = Tag::where('id', $req->tags)->first();
        $tname = Tag::where('tag_name', $req->tags)->first();

        if (!$tname) {
            $tag = new Tag;
            $tag->tag_name = $req->tags;
            $tag->save();
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }
    public function filterpost($id)
    {

        // $tagid = explode(" ", $post->tags_id);
        $posts = Post::where('tags_id', $id)->get();
        $tag = Tag::get();
        return view('home', compact('posts', 'tag'));
        // return dd($tagid);
    }
    function destroy($id)
    {
            $data = Tag::find($id);
            $data->delete();
            return redirect('home');       
    }
    public function createpost(Request $req)
    {
        $img = $req->image->store('image', 'public');
        $tag_id = implode(" ", $req->id);

        $response=Post::create([
            'title' => $req->title,
            'description' => $req->description,
            'image' => $img,
            'users_id' => Auth::user()->id,
            'tags_id' => $tag_id,
            
        ]);
        $user=Auth::user();

        $usern=Auth::user()->name;
       
        $title=$response->title;
    
        $details=[
            'greetings'=>$usern,
            'body'=>$title,
            'uploaded'=>'Uploaded new Post'
        ];
    
        // return $data;
        Notification::send($user, new postnotify($details));
        return redirect()->back();
    }
    
  
    function addcomment(Request $req, $id)
    {
        $Cres=Comment::create([
            'comment' => $req->comment,
            'posts_id' => $id,
            
        ]);
        $user=Auth::user();
        $usern=Auth::user()->name;
        $com=$Cres->comment;
    
        $cdetails=[
            'greetings'=>$usern,
            'body'=>$com,
            'commented'=>'Commented on Post'
        ];
    
        // return $data;
        Notification::send($user, new commentnotify($cdetails));
        return redirect()->back();
    }
}
