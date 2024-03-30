<?php

use App\Http\Controllers\TicketController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/ticket',[TicketController::class, 'index'])->name('ticket.index')->middleware('auth');
Route::get('/',[TicketController::class, 'create'])->name('create');
Route::get('/logout',[TicketController::class, 'logout'])->name('logout')->middleware('auth');
Route::post('ticket/insert', [TicketController::class, 'insert'])->name('ticket.insert');
Route::put('ticket/update/{id}', [TicketController::class, 'update'])->name('ticket.update')->middleware('auth');
Route::get('ticket/edit/{id}', [TicketController::class, 'edit'])->name('ticket.edit')->middleware('auth');
Route::delete('ticket/delete/{id}',[TicketController::class, 'delete'])->name('ticket.delete')->middleware('auth');

Route::get('/users',[TicketController::class, 'users'])->name('users')->middleware('auth');
Route::post('/addUser',[TicketController::class, 'addUser'])->name('addUser')->middleware('auth');
Route::post('/ShowForm',[TicketController::class, 'ShowForm'])->name('ShowForm')->middleware('auth');
Route::get('/ticketsUser',[TicketController::class, 'ticketsUser'])->name('ticketsUser')->middleware('auth');
Route::put('users/updateUser/{id}', [TicketController::class, 'updateUser'])->name('updateUser')->middleware('auth');

Auth::routes();
