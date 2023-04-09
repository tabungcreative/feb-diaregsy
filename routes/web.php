<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\KompreController;
use App\Http\Controllers\BimbinganSkripsiController;
use App\Http\Controllers\MagangController;
use App\Http\Controllers\MengulangController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\SemproController;
use App\Http\Controllers\SPLController;
use App\Http\Controllers\UjianAkhirController;
use App\Http\Controllers\YudisiumController;
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
    ->prefix('studi-ekskursi')
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
// Route BimbinganSkripsi
Route::controller(BimbinganSkripsiController::class)
    ->prefix('bimbingan-skripsi')
    ->as('bimbinganSkripsi.')
    ->group(function () {
        Route::get('/{nim}/register', 'formRegister')->name('form-register');
        Route::post('/register', 'register')->name('register');
        Route::get('/list', 'list')->name('list');
        Route::get('/{nim}/edit', 'edit')->name('edit');
        Route::put('/{id}', 'update')->name('update');
        Route::get('/{id}/detail', 'detail')->name('detail');
    });

// Route Seminar Proposal
Route::controller(SemproController::class)
    ->prefix('seminar-proposal')
    ->as('sempro.')
    ->group(function () {
        Route::get('/{nim}/register', 'formRegister')->name('form-register');
        Route::post('/register', 'register')->name('register');
        Route::get('/list', 'list')->name('list');
        Route::get('/{nim}/edit', 'edit')->name('edit');
        Route::put('/{id}', 'update')->name('update');
        Route::get('/{id}/detail', 'detail')->name('detail');
    });
// Route Ujian Komprehensif
Route::controller(KompreController::class)
    ->prefix('ujian-komprehensif')
    ->as('kompre.')
    ->group(function () {
        Route::get('/{nim}/register', 'formRegister')->name('form-register');
        Route::post('/register', 'register')->name('register');
        Route::get('/list', 'list')->name('list');
        Route::get('/{nim}/edit', 'edit')->name('edit');
        Route::put('/{id}', 'update')->name('update');
        Route::get('/{id}/detail', 'detail')->name('detail');
    });
// Route Ujian Komprehensif
Route::controller(MengulangController::class)
    ->prefix('mengulang')
    ->as('mengulang.')
    ->group(function () {
        Route::get('/{nim}/register', 'formRegister')->name('form-register');
        Route::post('/register', 'register')->name('register');
        Route::get('/list', 'list')->name('list');
        Route::get('/{nim}/edit', 'edit')->name('edit');
        Route::put('/{id}', 'update')->name('update');
        Route::get('/{id}/detail', 'detail')->name('detail');
    });
// Route BimbinganSkripsi
Route::controller(UjianAkhirController::class)
    ->prefix('ujian-skripsi')
    ->as('ujianAkhir.')
    ->group(function () {
        Route::get('/{nim}/register', 'formRegister')->name('form-register');
        Route::post('/register', 'register')->name('register');
        Route::get('/list', 'list')->name('list');
        Route::get('/{nim}/edit', 'edit')->name('edit');
        Route::put('/{id}', 'update')->name('update');
        Route::get('/{id}/detail', 'detail')->name('detail');
    });
// Route Yudisium
Route::controller(YudisiumController::class)
    ->prefix('yudisium')
    ->as('yudisium.')
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


// authentication

Route::controller(AuthController::class)
    ->prefix('auth')
    ->as('auth.')
    ->group(function () {
        Route::get('/login', 'login')->name('login');
        Route::get('/logout', 'logout')->name('logout');
        Route::get('/callback', 'callback')->name('callback');
    });


/**
 * Admin  Router
 */

Route::middleware('custom-auth')->group(function () {
    Route::prefix('admin')
        ->as('admin.')
        ->group(function () {
            Route::get('/dashboard', function () {
                return view('admin/index');
            });
            Route::controller(\App\Http\Controllers\Admin\SPLController::class)
                ->prefix('studi-ekskursi')
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
                    Route::get('/{id}/surat-penempatan-magang', 'print')->name('print');
                });
            Route::controller(\App\Http\Controllers\Admin\BimbinganSkripsiController::class)
                ->prefix('bimbingan-skripsi')
                ->as('bimbinganSkripsi.')
                ->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('/{id}/detail', 'detail')->name('detail');
                    Route::post('/{id}/verify', 'verify')->name('verify');
                    Route::post('/{id}/create-message', 'createMessage')->name('create-message');
                    Route::get('/export', 'export')->name('export');
                    Route::get('/{id}/surat-tugas', 'suratTugas')->name('surat-tugas');
                    Route::get('/{id}/surat-bimbingan', 'suratBimbingan')->name('surat-bimbingan');
                    Route::delete('/{id}', 'delete')->name('delete');
                });
            Route::controller(\App\Http\Controllers\Admin\SemproController::class)
                ->prefix('seminar-proposal')
                ->as('sempro.')
                ->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('/{id}/detail', 'detail')->name('detail');
                    Route::post('/{id}/verify', 'verify')->name('verify');
                    Route::post('/{id}/create-message', 'createMessage')->name('create-message');
                    Route::get('/export', 'export')->name('export');
                });
            Route::controller(\App\Http\Controllers\Admin\KompreController::class)
                ->prefix('ujian-komprehensif')
                ->as('kompre.')
                ->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('/{id}/detail', 'detail')->name('detail');
                    Route::post('/{id}/verify', 'verify')->name('verify');
                    Route::post('/{id}/create-message', 'createMessage')->name('create-message');
                    Route::get('/export', 'export')->name('export');
                });
            Route::controller(\App\Http\Controllers\Admin\MengulangController::class)
                ->prefix('mengulang')
                ->as('mengulang.')
                ->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('/{id}/detail', 'detail')->name('detail');
                    Route::post('/{id}/verify', 'verify')->name('verify');
                    Route::post('/{id}/create-message', 'createMessage')->name('create-message');
                    Route::get('/export', 'export')->name('export');
                });

            Route::controller(\App\Http\Controllers\Admin\UjianAkhirController::class)
                ->prefix('ujian-skripsi')
                ->as('ujianAkhir.')
                ->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('/{id}/detail', 'detail')->name('detail');
                    Route::post('/{id}/verify', 'verify')->name('verify');
                    Route::post('/{id}/create-message', 'createMessage')->name('create-message');
                    Route::get('/export', 'export')->name('export');
                    Route::delete('/{id}', 'delete')->name('delete');
                });

            Route::controller(\App\Http\Controllers\Admin\YudisiumController::class)
                ->prefix('yudisium')
                ->as('yudisium.')
                ->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('/{id}/detail', 'detail')->name('detail');
                    Route::post('/{id}/verify', 'verify')->name('verify');
                    Route::post('/{id}/create-message', 'createMessage')->name('create-message');
                    Route::get('/export', 'export')->name('export');
                });

            Route::controller(\App\Http\Controllers\Admin\TahunAjaranController::class)
                ->prefix('tahun-ajaran')
                ->as('tahunAjaran.')
                ->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::post('/', 'store')->name('store');
                    Route::post('/{id}/active', 'active')->name('active');
                    Route::post('/{id}/inActive', 'inActive')->name('inActive');
                });
        });
});
