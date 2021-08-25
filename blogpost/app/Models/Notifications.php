<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;

class Notifications extends Model
{
    use HasFactory;
    protected $gaurded=[];
    function posts()
    {
        return $this->belongsTo(Post::class, 'posts_id', 'id');
    }
}
