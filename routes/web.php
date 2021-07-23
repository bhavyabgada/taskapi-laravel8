<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

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

Route::get('/dashboard', function () {
    $tasks = Task::where('user_id',Auth::id())->latest()->get();
    $token = auth()->user()->createToken('LaravelAuthApp')->accessToken;
    return view('dashboard', ['tasks'=>$tasks, 'token'=>$token]);
})->middleware('auth')->name('dashboard');

Route::get('login', function () {
    return view('auth.login');
});

Route::post('login', [AuthenticationController::class, 'login'])->name('login'); 

Route::get('register', function () {
    return view('auth.register');
});

Route::post('register', [AuthenticationController::class, 'register'])->name('register'); 

Route::get('logout', [AuthenticationController::class, 'logout'])->name('logout');



