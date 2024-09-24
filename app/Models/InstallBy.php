<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Scope;

class InstallBy extends Model
{
    use HasFactory;
    protected $table = 'install_by';
    protected $fillable = ['install_by', 'is_del', 'user_id'];
    public $timestamps = false;
    protected $attributes = [
        'is_del' => 0, // Default value for is_del
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // assuming 'user_id' is the foreign key
    }

    // Boot method to automatically apply the global scope
    protected static function boot()
    {
        parent::boot();
        // Add a global scope to exclude inactive users
        static::addGlobalScope('activeUsers', function (Builder $builder) {
            $builder->whereHas('user', function($q) {
                $q->where('isActive', 1); // Assuming 'active = 1' means active
            });
        });
    }
}
