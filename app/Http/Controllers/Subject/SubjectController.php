<?php

namespace App\Http\Controllers\Subject;

use App\Http\Controllers\Controller;
use App\Http\Requests\Subject\SubjectRequest;
use App\Models\Room;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SubjectController extends Controller
{
    public function index($id){
        $room = Room::find($id);
        $subjects = $room->subjects;
        $RoomId=$room->id;
        return view('main.RoomSubjects',compact('subjects','RoomId'));
    }
    public function store(SubjectRequest $request,$id){
        try {
            $data = $request->validated();
            $data['room_id']=$id;
            Subject::create($data);
            return redirect()->back()->with('success', 'Subject created successfully.');
        } catch (\Exception $e) {
            Log::error('Subject creation failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Subject Error .');
        }
    }
}
