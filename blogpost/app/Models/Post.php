<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Tag;
use App\Models\Comment;
use App\Models\Notification;

class Post extends Model
{
    use HasFactory;
//    protected $guarded = [];
protected $guarded=[];
    function user()
    {
        return $this->belongsTo(User::class,'users_id','id');
    }
    function tag()
    {
        return $this->belongsTo(Tag::class, 'tags_id', 'id');
    }
    function comments()
    {
        return $this->hasMany(Comment::class, 'posts_id', 'id');
    }
    function notifications()
    {
        return $this->hasMany(Notification::class, 'posts_id', 'id');
    }
    
    
    
}
