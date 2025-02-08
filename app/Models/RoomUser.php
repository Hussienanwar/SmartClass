<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomUser extends Model
{
    protected $fillable = [
        'user_id',
        'room_id',
        'role',
    ];
}
