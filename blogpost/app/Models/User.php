<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Payment;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    function post()
    {
        return $this->hasMany(Post::class,'users_id','id');
    }
    function comments()
    {
        return $this->hasMany(Comment::class,'users_id','id');
    }
    function payment()
    {
        return $this->hasMany(Payment::class, 'pay_id', 'payment_done');
    }
}
