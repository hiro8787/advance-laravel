<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\AdvanceController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PaymentController;

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
Route::get('/search', [AdvanceController::class,'search'])->name('search');
Route::post('/register', [RegisterController::class,'register']);
Route::get('/verification', [RegisterController::class, 'getVerification'])->name('verification');
Route::get('/verification/notice', function () {
    return view('auth.verify');
})->name('verification.notice');
Route::post('/verification/resend', [RegisterController::class, 'resendVerificationEmail'])->name('verification.resend');
Route::post('/login', [AdvanceController::class, 'login'])->middleware('verified')->name('login');

Route::prefix('payment')->name('payment.')->group(function () {
    Route::get('/create', [PaymentController::class, 'create'])->name('create');
    Route::post('/store', [PaymentController::class, 'store'])->name('store');
});

Route::get('/confirmation', [AdvanceController::class,'confirmation']);

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