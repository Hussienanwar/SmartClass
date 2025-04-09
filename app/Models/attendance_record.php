<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class attendance_record extends Model
{
    protected $fillable = ['room_id', 'attendance_id','student_id','status'];

}
