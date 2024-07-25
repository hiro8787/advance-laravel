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

Route::get('/', [AdvanceController::class,'index']);
Route::post('/register', [AdvanceController::class,'register']);
Route::get('/search', [AdvanceController::class,'search'])->name('search');
Route::middleware('auth')->group(function () {
    Route::post('/detail', [AdvanceController::class,'detail']);
    Route::get('/detail', [AdvanceController::class,'detail']);
    Route::post('/like', [AdvanceController::class, 'toggleLike'])->name('like.toggle');
    Route::post('/done', [AdvanceController::class,'done']);
    Route::get('/done', [AdvanceController::class,'done']);
    Route::post('/back', [AdvanceController::class,'back']);
    Route::get('/my_page', [AdvanceController::class,'my_page']);
    Route::get('/delete', [AdvanceController::class,'delete']);
    Route::get('/edit', [AdvanceController::class,'edit']);
    Route::post('/edit', [AdvanceController::class,'update']);
    Route::get('/review', [AdvanceController::class,'review']);
    Route::POST('/posting', [AdvanceController::class,'posting']);
});