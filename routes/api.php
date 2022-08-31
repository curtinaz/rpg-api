<?php

use App\Http\Controllers\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Users
Route::post('users/login', [UsersController::class, 'login']);
Route::post('users/register', [UsersController::class, 'register']);
