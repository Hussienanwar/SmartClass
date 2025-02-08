<?php

use App\Http\Controllers\features\FeatureController;
use App\Http\Controllers\GoogleAuth\GoogleAuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Room\RoomController;
use App\Http\Controllers\Subject\SubjectController;
use Illuminate\Support\Facades\Route;

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


Route::match(['get', 'post'], '/room/join', [RoomController::class, 'join'])->name('room.join');

Route::post('/room', [RoomController::class, 'store'])->name('room.store');
Route::get('/room/index/{id}', [RoomController::class, 'index'])->name('room.index');
Route::post('/subject/store/{id}', [SubjectController::class, 'store'])->name('subject.store');
Route::get('/features/{id}', [FeatureController::class, 'index'])->name('features.index');

// GoogleLoginController redirect and callback urls
Route::get('/login/google', [GoogleAuthController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/login/google/callback', [GoogleAuthController::class, 'handleGoogleCallback']);



require __DIR__.'/auth.php';
