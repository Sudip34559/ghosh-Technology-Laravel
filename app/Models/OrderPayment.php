<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Payment extends Model
{
    use HasFactory;
    protected $table = 'order_payments';
    protected $fillable = [
        'order_id',
        'delivery_boy',
        'payment_type',
        'payment_status',
        'amount',
    ];

    public function order(){        
        return $this->belongsTo(User::class, 'order_id',  'id');
    }   
}

