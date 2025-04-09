<?php

namespace App\Http\Controllers\Attendance;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\AttendanceRecord;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\RoomUser;

use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Cache;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class AttendanceController extends Controller
{
    public function indexAdmin($id)
    {
        $room = Room::with(['attendanceCards.records', 'students'])->findOrFail($id);
        return view('main.attend.attendance', compact('room'));
    }
    public function index($roomId)
    {
        $room = Room::with(['attendanceCards.records', 'students'])->findOrFail($roomId);
    
        // Get the logged-in user's RoomUser record
        $roomUser = RoomUser::where('user_id', auth()->id())
                            ->where('room_id', $roomId)
                            ->first();
    
        if (!$roomUser || !$roomUser->code) {
            return view('main.attend.memberattendance', compact('room'))
            ->with('error', 'You have not entered a code yet. Please enter your code.');
        }
    
        // Find the student by code
        $student = Student::where('room_id', $roomId)
        ->where('code', $roomUser->code)
                          ->with('attendanceRecords')
                          ->first();
    
        if (!$student) {
            return view('main.attend.memberattendance', compact('room'))->with('error', 'No student found with your code.');
        }
    
        // Generate QR Code
        $qrCode = QrCode::size(200)->generate($student->code);
    
        return view('main.attend.memberattendance', compact('room', 'student', 'qrCode'));
    }

    public function store(Request $request, $roomId)
    {
        $room = Room::findOrFail($roomId);

        $attendance = Attendance::create([
            'name' => $request->name,
            'room_id' => $roomId,
        ]);

        $records = $room->students->map(function ($student) use ($roomId, $attendance) {
            return [
                'student_id' => $student->id,
                'room_id' => $roomId,
                'attendance_id' => $attendance->id,
                'status' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        })->toArray();

        AttendanceRecord::insert($records);

        return redirect()->route('attendance.indexAdmin', $roomId)->with('success', 'The Attend Session Maded Succussfully');
    }

    public function getStudents($roomId)
    {
        $students = Room::findOrFail($roomId)->students()->select(['id', 'name', 'code', 'section'])->get();
        $attendances = Attendance::where('room_id', $roomId)->orderBy('id')->pluck('id')->toArray();

        return DataTables::of($students)
            ->addColumn('attendance', function ($student) use ($roomId, $attendances) {
                $attendanceRecords = AttendanceRecord::where('student_id', $student->id)
                    ->where('room_id', $roomId)
                    ->pluck('status', 'attendance_id');

                $statuses = [];
                foreach ($attendances as $attendanceId) {
                    $statuses[] = isset($attendanceRecords[$attendanceId]) ? ($attendanceRecords[$attendanceId] ? '✅' : '❌') : '❌';
                }

                return $statuses;
            })
            ->rawColumns(['attendance'])
            ->make(true);
    }

    public function connect(Request $request, $roomId)
{
    $request->validate([
        'code' => 'required|string',
    ]);

    $room = Room::findOrFail($roomId);

    // Find the logged-in user's RoomUser record for the given room
    $roomUser = RoomUser::where('user_id', auth()->id())
                        ->where('room_id', $roomId)
                        ->first();

    if (!$roomUser) {
        return back()->with('error', 'You are not assigned to this room.');
    }

    // Check if a student with the provided code exists in the room
    $studentExists = Student::where('room_id', $roomId)
                            ->where('code', $request->code)
                            ->exists();

    if (!$studentExists) {
        return back()->with('error', 'Invalid code. No student found with this code.');
    }

    // Update the RoomUser's code field
    $roomUser->update(['code' => $request->code]);

    return back()->with('success', 'Successfully connected and updated your code.');
}

    
}
