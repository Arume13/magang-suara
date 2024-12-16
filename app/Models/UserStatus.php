<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserStatus extends Model
{
    protected $fillable = [
        'name',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Scope to get active users
    public function scopeActive($query)
    {
        return $query->where('active', true);
    }
}
