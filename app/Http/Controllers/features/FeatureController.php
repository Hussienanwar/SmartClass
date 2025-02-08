<?php

namespace App\Http\Controllers\features;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;

class FeatureController extends Controller
{
    public function index($id)
{
    $subject = Subject::findOrFail($id); // Fetch the subject or return 404
    $roomId = $subject->room_id; // Get the associated room ID

    return view('main.features', compact('subject', 'roomId')); // Pass subject & roomId
}

}
