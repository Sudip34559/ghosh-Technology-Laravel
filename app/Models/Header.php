<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Header extends Model
{
    // Specify the table if it's not the default naming convention
    protected $table = 'headers';

    // Specify the fillable columns for mass assignment
    protected $fillable = ['header', 'subheader'];

    // Cast the subheader column to an array to work with JSON data
    protected $casts = [
        'subheader' => 'array',
    ];
    public $timestamps = false;
}
