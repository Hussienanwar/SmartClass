<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Room extends Model
{
    protected $fillable = [
        'name',
        'path',
        'code'
    ];

    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'room_users', 'room_id', 'user_id')->withPivot('role');;
    }
    public function students()
    {
        return $this->hasMany(Student::class, 'room_id');
    }

    public function roomUsers()
    {
        return $this->hasMany(RoomUser::class);
    }

    public function attendanceRecords()
    {
        return $this->hasMany(AttendanceRecord::class);
    }
    public function userRole($userId)
    {
        return $this->roomUsers()->where('user_id', $userId)->value('role');
    }
    public function attendanceCards()
    {
        return $this->hasMany(Attendance::class);
    }
}
