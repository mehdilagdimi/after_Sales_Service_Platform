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
    return view('staticpage');
    })->name('home')
      ->middleware('auth');

Route::get('/signup', [RegisterController::class, 'index']);
Route::post('/signup', [RegisterController::class, 'store'])->name('signup');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')
        ->middleware('auth');

Route::get('/auth', [AuthController::class, 'index']);
Route::post('/auth', [AuthController::class, 'auth'])->name('auth');

Route::get('/dashboard', [DashBoardController::class, 'adminBoard'])->name('showAdminBoard');
Route::get('/dashboard', [DashBoardController::class, 'index'])->name('dashboard');
// Route::post('/dashboard', [DashBoardController::class, 'index'])->name('dashboard');
        // ->middleware('auth');

Route::get('/tickets', [TicketController::class, 'index'])->name('showTickets');
Route::post('/ticket/create', [TicketController::class, 'create'])->name('createTicket');
Route::post('/ticket/store', [TicketController::class, 'store'])->name('storeTicket');
Route::post('/ticket/delete', [TicketController::class, 'destroy'])->name('deleteTicket');
Route::post('/ticket/resolve', [TicketController::class, 'resolve'])->name('resolveTicket');
Route::post('/ticket/close', [TicketController::class, 'close'])->name('closeTicket');
Route::delete('/ticket/delete', [TicketController::class, 'destroy'])->name('deleteTicket');

// Route::get('/tickets/{id}', [TicketController::class, 'ticket'])->name('getTicket')
// Route::get('/tickets/{ref}', [TicketController::class, 'ticket'])->name('getTicket')
    // ->middleware('auth');

    
Route::get('/ticket/destroy', [TicketController::class, 'destroy'])->name('destroy');
Route::delete('/user/delete', [UserController::class, 'destroy'])->name('deleteUser');


Route::get('/ticket/{id}', [ResponseController::class, 'index'])->name('getTicket');

Route::post('/responses/create', [ResponseController::class, 'create'])->name('createResponse');
Route::post('/responses/store', [ResponseController::class, 'store'])->name('storeResponse');
Route::post('/responses/edit', [ResponseController::class, 'edit'])->name('editResponse');
Route::post('/responses/update', [ResponseController::class, 'update'])->name('updateResponse');
Route::delete('/responses/delete', [ResponseController::class, 'destroy'])->name('deleteResponse');

