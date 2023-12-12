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
const USER_MANAGE_PATH = App\Http\Controllers\UserManagementsController::class;
const TROUBLE_MANAGE_PATH = App\Http\Controllers\TroubleManagementsController::class;

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

Route::prefix('/admin/user')
    ->middleware('auth', 'adminAuth')
    ->name('admin.user.')
    ->group(function () {
        Route::get('/', [USER_MANAGE_PATH, 'userIndex'])->name('index');
        Route::post('/{id}', [USER_MANAGE_PATH, 'userDelete'])->name('delete');
        Route::get('/detail/{id}', [USER_MANAGE_PATH, 'userDetail'])->name('detail');
        Route::get('/create/input', [USER_MANAGE_PATH, 'userCreateInput'])->name('create.input');
        Route::post('/create/input', [USER_MANAGE_PATH, 'userCreateSend'])->name('create.send');
        Route::get('/create/result', [USER_MANAGE_PATH, 'userCreateResult'])->name('create.result');
        Route::get('/edit/input/{id}', [USER_MANAGE_PATH, 'userEditInput'])->name('edit.input');
        Route::post('/edit/input/{id}', [USER_MANAGE_PATH, 'userEditsend'])->name('edit.send');
        Route::get('/edit/result/{id}', [USER_MANAGE_PATH, 'userEditResult'])->name('edit.result');
    });

Route::prefix('/admin/trouble')
    ->middleware('auth', 'adminAuth')
    ->name('admin.trouble.')
    ->group(function () {
        Route::get('/', [TROUBLE_MANAGE_PATH, 'troubleIndex'])->name('index');
        Route::post('/{id}', [TROUBLE_MANAGE_PATH, 'troubleDelete'])->name('delete');
        Route::get('/detail/{id}', [TROUBLE_MANAGE_PATH, 'troubleDetail'])->name('detail');
        Route::get('/create/input', [TROUBLE_MANAGE_PATH, 'troubleCreateInput'])->name('create.input');
        Route::post('/create/input', [TROUBLE_MANAGE_PATH, 'troubleCreateSend'])->name('create.send');
        Route::get('/create/result', [TROUBLE_MANAGE_PATH, 'troubleCreateResult'])->name('create.result');
        Route::get('/edit/input/{id}', [TROUBLE_MANAGE_PATH, 'troubleEditInput'])->name('edit.input');
        Route::post('/edit/input/{id}', [TROUBLE_MANAGE_PATH, 'troubleEditsend'])->name('edit.send');
        Route::get('/edit/result/{id}', [TROUBLE_MANAGE_PATH, 'troubleEditResult'])->name('edit.result');
    });
