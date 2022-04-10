<?php

//this namespace has been added to make controllers defined here instead of using use with every controller
namespace App\Http\Controllers; 

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashBoardController;
use Illuminate\Support\Facades\Route;

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
    return view('index');
})->name('home');

Route::get('/signup', [RegisterController::class, 'index']);
Route::post('/signup', [RegisterController::class, 'store'])->name('signup');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')
        ->middleware('auth');

Route::get('/auth', [AuthController::class, 'index']);
Route::post('/auth', [AuthController::class, 'auth'])->name('auth');

Route::get('/dashboard', [DashBoardController::class, 'index'])->name('dashboard');
        // ->middleware('auth');

Route::get('/tickets', [TicketController::class, 'index'])->name('tickets')
    ->middleware('auth');
Route::post('/tickets', [TicketController::class, 'store'])->name('tickets');

Route::get('/tickets/{ref}', [TicketController::class, 'ticket'])
    ->middleware('auth');

    
Route::get('/destroy', [TicketController::class, 'destroy'])->name('destroy');

