<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KlantenController;



Route::get('/', [KlantenController::class, 'create']);


Route::get('/login', [AuthController::class, 'showLogin'])->name('login.show');
Route::post('/login', [AuthController::class, 'login'])->name('login.perform');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/tickets/create', [KlantenController::class, 'create'])->name('tickets.create');
Route::post('/tickets', [KlantenController::class, 'store'])->name('tickets.store');


Route::middleware('auth')->group(function () {
    Route::get('/tickets', [KlantenController::class, 'index'])->name('tickets.index');
    Route::get('/tickets/{klanten}/edit', [KlantenController::class, 'edit'])->name('tickets.edit');
    Route::put('/tickets/{klanten}', [KlantenController::class, 'update'])->name('tickets.update');
    Route::delete('/tickets/{klanten}', [KlantenController::class, 'destroy'])->name('tickets.destroy');
});