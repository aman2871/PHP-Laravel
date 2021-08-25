<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;

class Tag extends Model
{
    use HasFactory;
    protected $guarded = [];
    function post()
    {
        return $this->hasMany(Post::class, 'tags_id', 'id');
    }
}
