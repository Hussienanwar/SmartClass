<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = ['room_id', 'name'];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
    public function records()
{
    return $this->hasMany(attendance_record::class);
}

}
