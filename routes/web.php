<?php

use App\Http\Controllers\MagangController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\SPLController;
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

Route::get('/', function () {
    return view('welcome');
});

// Route cek nim 
Route::get('cek-nim', function () {
    return view('mahasiswa.cek-nim');
});

// Route SPL
Route::controller(SPLController::class)
    ->prefix('spl')
    ->as('spl.')
    ->group(function () {
        Route::get('/{nim}/register', 'formRegister')->name('form-register');
        Route::post('/register', 'register')->name('register');
        Route::get('/list', 'list')->name('list');
        Route::get('/{nim}/edit', 'edit')->name('edit');
        Route::put('/{id}', 'update')->name('update');
        Route::get('/{id}/detail', 'detail')->name('detail');
    });

// Route Magang
Route::controller(MagangController::class)
    ->prefix('magang')
    ->as('magang.')
    ->group(function () {
        Route::get('/{nim}/register', 'formRegister')->name('form-register');
        Route::post('/register', 'register')->name('register');
        Route::get('/list', 'list')->name('list');
        Route::get('/{nim}/edit', 'edit')->name('edit');
        Route::put('/{id}', 'update')->name('update');
        Route::get('/{id}/detail', 'detail')->name('detail');
    });
// Route Pendaftaran mahasiswa 
Route::controller(PendaftaranController::class)
    ->prefix('pendaftaran')
    ->as('pendaftaran.')
    ->group(function () {
        Route::get('/cek-nim', 'formCekNim')->name('form-cek-nim');
        Route::post('/cek-nim', 'cekNim')->name('cek-nim');
        Route::get('/{nim}/list', 'list')->name('list');
    });



/**
 * Admin  Router
 */
Route::prefix('admin')
    ->as('admin.')
    ->group(function () {
        Route::controller(\App\Http\Controllers\Admin\SPLController::class)
            ->prefix('spl')
            ->as('spl.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/{id}/detail', 'detail')->name('detail');
                Route::post('/{id}/verify', 'verify')->name('verify');
                Route::post('/{id}/create-message', 'createMessage')->name('create-message');
                Route::get('/export', 'export')->name('export');
            });
        Route::controller(\App\Http\Controllers\Admin\MagangController::class)
            ->prefix('magang')
            ->as('magang.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/{id}/detail', 'detail')->name('detail');
                Route::post('/{id}/verify', 'verify')->name('verify');
                Route::post('/{id}/create-message', 'createMessage')->name('create-message');
                Route::get('/export', 'export')->name('export');
            });
    });