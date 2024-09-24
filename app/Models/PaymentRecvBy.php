<?php

namespace App\Models;

use App\Models\Registration;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaymentRecvBy extends Model
{
    use HasFactory;
    protected $table = 'pay_recv_by';
    protected $fillable = ['pay_recv_by', 'is_del'];
    public $timestamps = false;
    protected $attributes = [
        'is_del' => 0, // Default value for is_del
    ];
    // Relationship for 'registration'
    public function registration()
    {
        return $this->hasOne(Registration::class, 'pay_recv_by');
    }
}
