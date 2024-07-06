<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdvanceController;

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
/*Route::middleware('auth')->group(function () {
    Route::get('/', [AdvanceController::class, 'index']);
});
*/
Route::get('/', [AdvanceController::class,'index']);
Route::post('/', [AdvanceController::class,'index']);
Route::get('/search', [AdvanceController::class, 'search'])->name('search');
Route::middleware('auth')->group(function () {
    Route::post('/detail', [AdvanceController::class,'detail']);
    Route::get('/detail', [AdvanceController::class,'detail']);
    Route::post('/like', [AdvanceController::class, 'toggleLike'])->name('like.toggle');
    Route::get('/done', [AdvanceController::class,'done']);
    Route::post('/done', [AdvanceController::class,'done']);
    Route::post('/back', [AdvanceController::class,'back']);


Route::get('/thanks', [AdvanceController::class,'thanks']);
});