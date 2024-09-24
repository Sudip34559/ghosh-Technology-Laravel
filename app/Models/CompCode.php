<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompCode extends Model
{
    use HasFactory;
    protected $table = 'com_code';
    protected $fillable = ['com_code', 'is_del'];
    public $timestamps = false;
    protected $attributes = [
        'is_del' => 0, // Default value for com_code
    ];
}
