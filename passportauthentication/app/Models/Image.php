<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Image extends Model
{
    use HasFactory;
    protected $fillable=[
        'image',
        'users_id'
    ];
    protected $table='image';

    function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
}
