<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Imports\StudentsImport;
use App\Models\Room;
use App\Models\Student;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Validation\ValidationException;
use Yajra\DataTables\DataTables;

class StudentController extends Controller
{
    public function index($id)
    {
        $room = Room::with('students')->findOrFail($id);
        return view('main.Room.import', compact('room'));
    }
    public function getStudents($roomId)
{
    $room = Room::findOrFail($roomId);

    try {
    $students = $room->students()->select(['id', 'name', 'code', 'section'])->get();

    return DataTables::of($students)
        ->addIndexColumn()
        ->make(true);

} catch (\Exception $e) {
    return response()->json(['error' => $e->getMessage()], 500);
}

}
    public function importStudents(Request $request, $room_id)
    {
        $room = Room::findOrFail($room_id);
        $request->validate([
            'file' => 'required|mimes:xlsx,csv|max:2048',
        ]);

        try {
            Excel::import(new StudentsImport($room->id), $request->file('file'));
            return back()->with('success', 'Students imported successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['import_error' => $e->getMessage()]);
        }
    }


}
