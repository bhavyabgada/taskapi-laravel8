<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\TaskController;


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
    return view('welcome');
});

Route::get('dashboard', [TaskController::class, 'dashboard'])->middleware('auth')->name('dashboard');

Route::get('login', function () {
    return view('auth.login');
});

Route::post('login', [AuthenticationController::class, 'login'])->name('login'); 

Route::get('register', function () {
    return view('auth.register');
});

Route::post('register', [AuthenticationController::class, 'register'])->name('register'); 

Route::get('logout', [AuthenticationController::class, 'logout'])->name('logout');



