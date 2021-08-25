<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $casts=[
        'images' => 'array',
        // 'images',
        // 'users_id'
    ];
    protected $fillable=[
        'users_id',
        'images'
    ];
    public function setFilenamesAttribute($value)
    {
        $this->attributes['filenames'] = json_encode($value);
       

    }
}
