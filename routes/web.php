<?php

use App\Http\Controllers\Attendance\AttendanceController;
use App\Http\Controllers\features\FeatureController;
use App\Http\Controllers\GoogleAuth\GoogleAuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Room\RoomController;
use App\Http\Controllers\Subject\SubjectController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Student\StudentController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post( '/room/join', [RoomController::class, 'join'])->name('room.join');
Route::post('/room', [RoomController::class, 'store'])->name('room.store');
Route::get('/room/{id}', [RoomController::class, 'show'])->name('room.show');

Route::get('/room/{id}/students', [StudentController::class, 'index'])->name('students.index');
Route::get('/room/{id}/members', [RoomController::class, 'members'])->name('rooms.members');
Route::get('/attendance/create/{id}', [AttendanceController::class, 'index'])->name('attendance.index');
Route::get('/attendance/create/admin/{id}', [AttendanceController::class, 'indexAdmin'])->name('attendance.indexAdmin');
Route::post('/attendance/create/{id}', [AttendanceController::class, 'store'])->name('attendance.store');
Route::get('/attendance/{roomId}/students', [AttendanceController::class, 'getStudents'])->name('attendance.students');
Route::post('/attendance/student/connect/{roomId}', [AttendanceController::class, 'connect'])->name('attendance.connect');

// GoogleLoginController redirect and callback urls
Route::get('/login/google', [GoogleAuthController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/login/google/callback', [GoogleAuthController::class, 'handleGoogleCallback']);

Route::get('/students/upload', [StudentController::class, 'showUploadForm']);
// Route::post('/students/d:\dashboard\assets', [StudentController::class, 'import'])->name('students.import');
Route::post('/rooms/{room}/import-students', [StudentController::class, 'importStudents'])
    ->name('students.import');
require __DIR__.'/auth.php';
