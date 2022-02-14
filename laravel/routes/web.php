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
Route::get('/buktimemorial/{noJurnal}', [JurnalController::class, 'buktiMemorial']);
Route::get('/buktikaskeluar/{noJurnal}/{title}', [JurnalController::class, 'buktiKeluar']);
Route::get('/buktikasmasuk/{noJurnal}/{title}', [JurnalController::class, 'buktiMasuk']);
Route::get('/buktibank/{noJurnal}/{title}', [JurnalController::class, 'buktiKeluar']);
Route::get('/buktibankmasuk/{noJurnal}/{title}', [JurnalController::class, 'buktiMasuk']);
