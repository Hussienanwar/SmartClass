<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RoomUser extends Model
{
    protected $fillable = [
        'user_id',
        'room_id',
        'role',
        'code'
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
