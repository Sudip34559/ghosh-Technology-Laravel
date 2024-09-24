<?php

namespace App\Models;

use App\Models\CallBy;
use App\Models\Product;
use App\Models\InstallBy;
use App\Models\CallRecord;
use App\Models\PaymentRecvBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Registration extends Model
{
    use HasFactory;
    protected $table = 'reg';
    public $timestamps = false;
    protected $fillable = [
       'expiry_date',
       'product',
       'installation_date',
       'ins_by',
       'customer_name',
       'email_id',
       'mobile_no',
       'product_key_1',
       'product_key_2',
       'product_key_3',
       'product_key_4',
       'product_key_5',
       'product_key_6',
       'product_key_7',
       'product_key_8',
       'product_key_9',
       'product_key_10',
       'renewal_key',
       'amount',
       'address',
       'batch_no',
       'call_by',
       'payment_received_by',
       'com_code',
       'call_done',
       'call_comment',
       'review',
       'review_comment'
    ];
     

    public function products()
    {
        return $this->belongsTo(Product::class, 'product');
    }

    // Relationship for 'installed by'
    public function installedBy()
    {
        return $this->belongsTo(InstallBy::class, 'ins_by');  
    }

    // Relationship for 'call by'
    public function calledBy()
    {
        return $this->belongsTo(CallBy::class, 'call_by');  
    }

    // Relationship for 'payment received by'
    public function paymentReceivedBy()
    {
        return $this->belongsTo(PaymentRecvBy::class, 'payment_received_by');  
    }
    public function callRecords()
    {
        return $this->hasMany(CallRecord::class, 'cust_id');
    }
}
