<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\TestControllers\DeleteController;
use App\Http\Controllers\TestControllers\DeleteParamController;
use App\Http\Controllers\UserController;

Auth::routes();

Route::resource('users', UserController::class);

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/test', [RegisterController::class, 'register']);
// Route::delete('/', [DeleteController::class, 'deleteAll'])->name('test.deleteAll');

Route::delete('/test/{email}',[DeleteParamController::class,'delete'])->name('test.delete');