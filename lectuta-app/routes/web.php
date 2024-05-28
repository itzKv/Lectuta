<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AssemblyAI_Controller;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/goToLogin', function() {
    return view('auth/login');
});

// AssemblyAI Transcription Route
Route::get('/transcribe-form', function () {
    return view('placeholder/transcribe_AI_test');
});



Auth::routes();
// Login Register Route
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/auth/login', [App\Http\Controllers\Auth\LoginController::class, 'index'])->name('goToLogin');
Route::get('/auth/register', [App\Http\Controllers\Auth\RegisterController::class, 'index'])->name('goToRegister');
Route::get('/auth/passwords/confirm', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'index'])->name('goToForgot');




// Audio Upload Route
Route::get('/audio/upload', [App\Http\Controllers\AudioController::class, 'index'])->name('goToUploadAudio');
Route::post('/audio/upload', [App\Http\Controllers\AudioController::class, 'upload'])->name('uploadAudio');
Route::delete('/audio/upload', [App\Http\Controllers\AudioController::class, 'delete'])->name('deleteAudio');




// AssemblyAI Transcription Route
Route::post('/transcribe', [AssemblyAI_Controller::class, 'transcribe']);
Route::get('/transcription-result', [AssemblyAI_Controller::class, 'showTranscriptionResult'])->name('transcription.result');
