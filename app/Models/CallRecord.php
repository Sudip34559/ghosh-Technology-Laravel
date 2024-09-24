<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CallRecord extends Model
{
    use HasFactory;
    protected $primaryKey = 'call_id';
    protected $table = 'call_record';
    protected $fillable = [
        'cust_id', 
        'call_note',
         'call_time', 
         'call_by', 
         'call_status',
          'created_tyme'

    ];
    public $timestamps = false;

    public function customers()
    {
        return $this->belongsTo(Registration::class, 'cust_id');
    }
    // Relationship for 'call by'
    public function calledBy(){
        return $this->belongsTo(CallBy::class, 'call_by');
    }
    // Relationship for 'call status'
    public function caseStatus(){
        return $this->belongsTo(CaseStatus::class, 'call_status');
    }

}
