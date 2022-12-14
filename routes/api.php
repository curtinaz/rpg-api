<?php

use App\Http\Controllers\RoomsController;
use App\Http\Controllers\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Users
Route::post('users/login', [UsersController::class, 'login']);
Route::post('users/register', [UsersController::class, 'register']);


// Rooms
Route::get('rooms', [RoomsController::class, 'index']);
Route::post('rooms', [RoomsController::class, 'create'])->middleware('auth:sanctum');
