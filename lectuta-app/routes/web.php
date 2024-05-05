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
Route::post('/audio/upload', [App\Http\Controllers\AudioController::class, 'upload']);