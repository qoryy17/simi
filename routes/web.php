<?php

use App\Http\Controllers\Authentication\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Room\RoomController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Dashboard\MainController;
use App\Http\Controllers\Officer\OfficerController;
use App\Http\Controllers\Position\PositionController;
use App\Http\Controllers\Authentication\SigninController;
use App\Http\Middleware\Auth\AuthMiddleware;
use App\Http\Middleware\Auth\NonAuthMiddleware;

Route::get('/', function () {
    return redirect()->route('autentifikasi.signin');
});

Route::controller(SigninController::class)->group(function () {
    Route::get('/signin', 'signin')->name('autentifikasi.signin')->middleware(NonAuthMiddleware::class);
});

Route::controller(AuthController::class)->group(function () {
    Route::post('/auth/login', 'authLogin')->name('auth.login');
    Route::post('/auth/logout', 'authLogout')->name('auth.logout');
});

Route::middleware(AuthMiddleware::class)->group(function () {
    Route::controller(MainController::class)->group(function () {
        Route::get('/dashboard/home', 'home')->name('dashboard.home');
        Route::get('/dashboard/pengguna', 'manageUser')->name('dashboard.pengguna');
        Route::get('/dashboard/guru-pegawai', 'manageOfficer')->name('dashboard.guru-pegawai');
        Route::get('/dashboard/jabatan', 'managePosition')->name('dashboard.jabatan');
        Route::get('/dashboard/ruangan', 'manageRoom')->name('dashboard.ruangan');
        Route::get('/dashboard/peminjaman', 'manageBorrowing')->name('dashboard.peminjaman');
        Route::get('/dashboard/pengaturan', 'manageSetting')->name('dashboard.pengaturan');
        Route::post('/pengaturan/save', 'saveSetting')->name('pengaturan.save');
    });
});

Route::middleware(AuthMiddleware::class)->group(function () {
    Route::controller(UserController::class)->group(function () {
        Route::get('/pengguna/form/{param}/{id}', 'formUser')->name('pengguna.form');
        Route::post('/pengguna/save', 'saveUser')->name('pengguna.save');
        Route::delete('/pengguna/delete', 'deleteUser')->name('pengguna.delete');
    });
});

Route::middleware(AuthMiddleware::class)->group(function () {
    Route::controller(PositionController::class)->group(function () {
        Route::get('/jabatan/form/{param}/{id}', 'formPosition')->name('jabatan.form');
        Route::post('/jabatan/save', 'savePosition')->name('jabatan.save');
        Route::delete('/jabatan/delete', 'deletePosition')->name('jabatan.delete');
    });
});

Route::middleware(AuthMiddleware::class)->group(function () {
    Route::controller(RoomController::class)->group(function () {
        Route::get('/ruangan/form/{param}/{id}', 'formRoom')->name('ruangan.form');
        Route::post('/ruangan/save', 'saveRoom')->name('ruangan.save');
        Route::delete('/ruangan/delete', 'deleteRoom')->name('ruangan.delete');
    });
});

Route::middleware(AuthMiddleware::class)->group(function () {
    Route::controller(OfficerController::class)->group(function () {
        Route::get('/pegawai/form/{param}/{id}', 'formOfficer')->name('guruPegawai.form');
        Route::post('/pegawai/save', 'saveOfficer')->name('guruPegawai.save');
        Route::delete('/pegawai/delete', 'deleteOfficer')->name('guruPegawai.delete');
    });
});
