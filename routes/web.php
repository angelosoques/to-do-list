<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TasksController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserContoller;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::middleware(['web'])->group(function() {
    Route::post('/register', [UserContoller::class, 'store']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/checkLogin', [AuthController::class, 'checkLogin']);
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::post('/task/update/{id}', [TasksController::class, 'update']);
    Route::post('/task/create', [TasksController::class, 'store']);
    Route::post('/search', [TasksController::class, 'show']);
});