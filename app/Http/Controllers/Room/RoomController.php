<?php

namespace App\Http\Controllers\Room;

use App\Http\Controllers\Controller;
use App\Http\Requests\Room\JoinRoomRequest;
use App\Http\Requests\Room\RoomRequest;
use App\Models\Room;
use App\Models\RoomUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class RoomController extends Controller
{
    public function index($id)
    {
        $room = Room::find($id);
    
        if (!$room) {
            return redirect()->back()->with('error', 'Room not found.');
        }
    
        // Generate the join URL using the GET request
        $joinUrl = route('room.join', ['code' => $room->code]);
    
        // Generate the QR code with the join URL
        $qrCode = QrCode::size(200)->generate($joinUrl);
    
        return view('main.Room', compact('room', 'qrCode'));
    }

    public function store(RoomRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $userId = Auth::id();
            $path = $request->file('path')->store('RoomImages', 'public');

            // Generate a unique room code
            do {
                $roomCode = Str::random(6); // Generates a random 6-character string
            } while (Room::where('code', $roomCode)->exists()); // Ensure uniqueness

            $data['code'] = $roomCode;
            $data['path'] = $path;
            $room = Room::create($data);
            RoomUser::create([
                'user_id' => $userId,
                'room_id' => $room->id,
                'role' => 'admin',
            ]);
            DB::commit();
            return redirect()->back()->with('success', 'Room created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Room creation failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Room Error .');
        }
    }
    public function join(Request $request)
    {
        DB::beginTransaction();
        try {
            // Get the room code from request (works for both GET and POST)
            $roomCode = $request->query('code') ?? $request->input('code');
    
            $room = Room::where('code', $roomCode)->first();
    
            if (!$room) {
                return redirect()->route('home')->with('error', 'Invalid room code.');
            }
    
            $userId = Auth::id();
    
            // Check if the user is already in the room
            $alreadyJoined = RoomUser::where('user_id', $userId)
                ->where('room_id', $room->id)
                ->exists();
    
            if ($alreadyJoined) {
                return redirect()->route('rooms.show', $room->id)->with('info', 'You are already in this room.');
            }
    
            // Add user to room
            RoomUser::create([
                'user_id' => $userId,
                'room_id' => $room->id,
                'role' => 'member',
            ]);
    
            DB::commit();
            return redirect()->route('rooms.show', $room->id)->with('success', 'You joined the room successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('home')->with('error', 'An error occurred while joining the room.');
        }
    }
    

}
