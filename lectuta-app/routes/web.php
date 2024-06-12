<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/goToLogin', function() {
    return view('auth/login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/auth/login', [App\Http\Controllers\Auth\LoginController::class, 'index'])->name('goToLogin');
Route::get('/auth/register', [App\Http\Controllers\Auth\RegisterController::class, 'index'])->name('goToRegister');
Route::get('/auth/passwords/confirm', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'index'])->name('goToForgot');
Route::get('/audio/upload', [App\Http\Controllers\AudioController::class, 'index'])->name('goToUploadAudio');
Route::post('/audio/upload', [App\Http\Controllers\AudioController::class, 'upload'])->name('uploadAudio');
Route::delete('/audio/upload', [App\Http\Controllers\AudioController::class, 'delete'])->name('deleteAudio');
Route::get('/notes', [App\Http\Controllers\NotesController::class, 'index'])->name('goToNotes');
Route::post('/notes', [App\Http\Controllers\NotesController::class, 'generate'])->name('generateNotes');
Route::get('/notes/mynotes', [App\Http\Controllers\NotesController::class, 'myNotes'])->name('goToMyNotes');
Route::delete('/notes/delete', [App\Http\Controllers\NotesController::class, 'deleteNote'])->name('deleteNotes');
Route::post('/notes/updateTitle', [App\Http\Controllers\NotesController::class, 'updateTitle'])->name('updateTitle');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login'); // Redirect to login page after logout
  });

Route::post('/deleteAccount', function () {
    $user = Auth::user();
    $user->delete();
    return redirect('/login'); // Redirect to login page after account deletion
  });
