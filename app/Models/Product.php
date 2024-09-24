<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'prod_list';
    protected $fillable = ['prod_list', 'qty', 'is_del'];
    public $timestamps = false;
    protected $attributes = [
        'is_del' => 0, // Default value for is_del
    ];
}
