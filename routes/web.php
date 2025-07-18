<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
})->name('dashboard');

Route::get('/index-user', [UserController::class, 'index'])->name('user.index');
Route::get('/show-user{user}', [UserController::class, 'show'])->name('user.show');


Route::get('/create-user', [UserController::class, 'create'])->name('user.create');
Route::post('/store-user', [UserController::class, 'store'])->name('user.store');


Route::get('/edit-user/{user}', [UserController::class, 'edit'])->name('user.edit');
Route::put('/update-user/{user}', [UserController::class, 'update'])->name('user.update');

Route::put('/edit-user-password/{user}', [UserController::class, 'editPassword'])->name('user.edit-password');
Route::put('/update-user-password/{user}', [UserController::class, 'updatePassword'])->name('user.update');
