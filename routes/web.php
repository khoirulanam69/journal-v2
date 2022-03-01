<?php

use App\Http\Controllers\JurnalController;
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

Route::get('/', [JurnalController::class, 'index']);
Route::get('/search', [JurnalController::class, 'search']);
Route::get('/buktimemorial/{bukti}', [JurnalController::class, 'buktiMemorial']);
Route::get('/buktimemorial/{year}/{month}/{day}/{number}', [JurnalController::class, 'buktiMemorialWithDate']);
Route::get('/buktikaskeluar/{bukti}/{title}', [JurnalController::class, 'buktiKeluarMasuk']);
Route::get('/buktikaskeluar/{year}/{month}/{day}/{number}/{title}', [JurnalController::class, 'buktiKeluarMasukWithDate']);
Route::get('/buktikasmasuk/{bukti}/{title}', [JurnalController::class, 'buktiKeluarMasuk']);
Route::get('/buktikasmasuk/{year}/{month}/{day}/{number}/{title}', [JurnalController::class, 'buktiKeluarMasukWithDate']);
Route::get('/buktibankkeluar/{bukti}/{title}', [JurnalController::class, 'buktiKeluarMasuk']);
Route::get('/buktibankkeluar/{year}/{month}/{day}/{number}/{title}', [JurnalController::class, 'buktiKeluarMasukWithDate']);
Route::get('/buktibankmasuk/{bukti}/{title}', [JurnalController::class, 'buktiKeluarMasuk']);
Route::get('/buktibankmasuk/{year}/{month}/{day}/{number}/{title}', [JurnalController::class, 'buktiKeluarMasukWithDate']);
