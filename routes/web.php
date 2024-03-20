<?php

use App\Http\Controllers\TradeController;
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

Route::get('/overview', [TradeController::class, 'overview']);

Route::get('/table', [TradeController::class, 'table']);

Route::get('/analytics', [TradeController::class, 'analytics']);

Route::get('/journal', [TradeController::class, 'journal']);


require __DIR__ . '/auth.php';
