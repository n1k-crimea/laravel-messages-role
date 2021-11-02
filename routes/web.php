<?php

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
    return redirect('/login');
});

Auth::routes();

Route::get('/client', [\App\Http\Controllers\MessageController::class, 'create'])->name('client_message_create')->middleware('client');
Route::post('/store', [\App\Http\Controllers\MessageController::class, 'store'])->name('client_message_store')->middleware('client');

Route::get('/manager', [\App\Http\Controllers\MessageController::class, 'index'])->name('manager_message_list')->middleware('manager');
Route::get('/switch-status/{id}', [\App\Http\Controllers\MessageController::class, 'edit'])->name('manager_message_edit')->middleware('manager');
