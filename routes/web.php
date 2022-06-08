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
Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/connect', [App\Http\Controllers\HomeController::class, 'connect'])->name('connect');
Route::get('/tracking', [App\Http\Controllers\HomeController::class, 'tracking'])->name('tracking');
Route::get('/record', [App\Http\Controllers\HomeController::class, 'record'])->name('record');
Route::get('/log-perjalanan', [App\Http\Controllers\HomeController::class, 'log'])->name('log-perjalanan');
