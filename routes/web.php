<?php

use App\Http\Controllers\HomeController;
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

Route::get('/test-data', [HomeController::class, 'test'])->name('test');
Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/address', [HomeController::class, 'address'])->name('address');
Route::post('/address', [HomeController::class, 'generate'])->name('generate');
Route::get('/transaction', [HomeController::class, 'transaction'])->name('transaction');
Route::post('/transaction', [HomeController::class, 'check'])->name('check');

