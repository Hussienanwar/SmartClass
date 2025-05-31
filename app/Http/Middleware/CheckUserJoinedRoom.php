<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Room;

class CheckUserJoinedRoom
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        $roomId = $request->route('room') ?? $request->route('roomId') ?? $request->route('id');
        if (!$user) {
            return abort(401, 'Unauthorized.');
        }
        // Check if the user has joined the room
        $joined = $user->rooms()->where('rooms.id', $roomId)->exists();
        if (!$joined) {
            return abort(403, 'You have not joined this room.');
        }
        return $next($request);
    }
}
