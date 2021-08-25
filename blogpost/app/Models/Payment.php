<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Payment extends Model
{
    protected $table='payment';
    use HasFactory;
    function user()
    {
        return $this->belongsTo(User::class, 'pay_id', 'payment_done');
    }
}
