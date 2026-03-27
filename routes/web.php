<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('home');
})->middleware('auth');

Route::get('/register', function () {
    return view('register');
})->middleware('guest');
Route::post('/register', [AuthController::class, 'registerPost']);

Route::get('/login', function () {
    return view('login');
})->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'loginPost']);

Route::post('/logout', [AuthController::class, 'logoutPost'])->middleware('auth');
