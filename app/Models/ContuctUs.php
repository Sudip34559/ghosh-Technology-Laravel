<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContuctUs extends Model
{
    use HasFactory;
    protected $table = 'contact_us';  // change table name if needed
    protected $fillable = ['name', 'email', 'phone', 'message'];
    public $timestamps = false;
}
