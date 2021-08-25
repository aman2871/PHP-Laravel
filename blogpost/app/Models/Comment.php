<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;

class Comment extends Model
{
    use HasFactory;
    protected $guarded = [];
    function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
    function post()
    {
        return $this->belongsTo(Post::class, 'posts_id', 'id');
    }
}
