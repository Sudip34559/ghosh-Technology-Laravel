<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TextSlider extends Model
{
    use HasFactory;
    // Specify the table if it's not the default naming convention
    protected $table = 'table_header_text_slide';

    // Specify the fillable columns for mass assignment
    protected $fillable = ['slidText'];
    public $timestamps = false;
}
