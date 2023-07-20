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

Route::get('/', [\App\Http\Controllers\Controller::class, 'index'])->name('index');
Route::get('/address', [\App\Http\Controllers\Controller::class, 'address'])->name('address');
Route::get('/transaction', [\App\Http\Controllers\Controller::class, 'transaction'])->name('transaction');

