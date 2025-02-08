<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Subject extends Model
{
    protected $fillable = [
        'name',
        'room_id',
    ];
    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }
}
