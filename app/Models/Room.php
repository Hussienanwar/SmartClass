<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Room extends Model
{
    protected $fillable = [
        'name','path','code'
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'room_users', 'room_id', 'user_id');
    }
    public function subjects(): HasMany
    {
        return $this->hasMany(Subject::class);
    }
}
