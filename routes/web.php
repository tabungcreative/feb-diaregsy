<?php

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

Route::get('cek-nim', function () {
    return view('mahasiswa.cek-nim');
});

Route::controller(SPLController::class)
    ->prefix('spl')
    ->as('spl.')
    ->group(function () {
        Route::get('/{nim}/register', 'formRegister')->name('form-register');
        Route::post('/register', 'register')->name('register');
        Route::get('/{id}/detail', 'detail')->name('detail');
    });

Route::controller(PendaftaranController::class)
    ->prefix('pendaftaran')
    ->as('pendaftaran.')
    ->group(function () {
        Route::get('/cek-nim', 'formCekNim')->name('form-cek-nim');
        Route::post('/cek-nim', 'cekNim')->name('cek-nim');
        Route::get('/{nim}/list', 'list')->name('list');
    });
