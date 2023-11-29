<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

const TROUBLE_REQUEST_PATH = App\Http\Controllers\TroubleReportsController::class;

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('/trouble_report')
    ->middleware('auth')
    ->name('trouble_report.')
    ->group(function () {
        Route::get('/input', [TROUBLE_REQUEST_PATH, 'reportInput'])->name('input');
        Route::post('/input', [TROUBLE_REQUEST_PATH, 'reportPost'])->name('post');
        Route::get('/confirm', [TROUBLE_REQUEST_PATH, 'reportConfirm'])->name('confirm');
        Route::post('/confirm', [TROUBLE_REQUEST_PATH, 'reportSend'])->name('send');
        Route::get('/result', [TROUBLE_REQUEST_PATH, 'reportResult'])->name('result');
    });
