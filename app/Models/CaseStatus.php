<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaseStatus extends Model
{
    use HasFactory;
    protected $table = 'case_status';   
    protected $fillable = [
        'case_status', 
        'is_del'
        
    ];
    public $timestamps = false;
    protected $attributes = [
        'is_del' => 0, // Default value for case_status
    ];
}
