<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\Post;

class TagCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $post = Post::get();
        $tagid = [];
        $tid=$request->route('id');
        // dd($tid);
        foreach ($post as $pos) {
            $tagid[] = $pos->tags_id;
        }
        $validate = in_array($tid, $tagid);
        // dd($tagid);

        if ($validate) {
                return redirect()->back();
        }
        else{
            return $next($request);
        }
        }
}
