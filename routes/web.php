<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;

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

Route::post('/register', [UsersController::class, 'insertUser']);

Route::get('/dashboard/{$userId}', function ($id, UsersController $usersController) {
    $user = $usersController->getUser($id);
    dd($user);
    return view('dashboard', ['userData' => $user]);
});