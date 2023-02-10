<?php

use App\Http\Controllers\NotesController;
use App\Http\Controllers\UserController;
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

Route::controller(UserController::class)->group(function () {
    Route::post('/process', 'process')->name('user.process')->middleware('guest'); // Login Process
    Route::post('/store', 'store')->name('user.store')->middleware('guest');
    Route::post('/logout', 'logout')->name('user.logout')->middleware('auth');
    Route::put('/user/update', 'update')->name('user.update')->middleware('auth');
});

Route::controller(NotesController::class)->group(function () {
    Route::get('/', 'index')->middleware('guest');
    Route::get('/show/{id}', 'show');
    Route::get('/search', 'search');
    Route::get('/note', 'index')->name('note')->middleware('auth');
    Route::post('/note/store', 'store')->name('note.store')->middleware('auth');
    Route::put('/note/update', 'update')->name('note.update')->middleware('auth');
    Route::delete('/note/destroy/{id}', 'destroy')->name('note.destroy')->middleware('auth');
});
