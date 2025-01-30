<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Auth\AuthMiddleware;
use App\Http\Controllers\Item\ItemController;
use App\Http\Controllers\Room\RoomController;
use App\Http\Controllers\User\UserController;
use App\Http\Middleware\Auth\NonAuthMiddleware;
use App\Http\Controllers\Item\UnitItemController;
use App\Http\Controllers\Dashboard\MainController;
use App\Http\Controllers\Officer\OfficerController;
use App\Http\Controllers\Position\PositionController;
use App\Http\Controllers\Item\ConditionItemController;
use App\Http\Controllers\Authentication\AuthController;
use App\Http\Controllers\Authentication\SigninController;
use App\Http\Controllers\Item\DistributionItemController;
use App\Http\Controllers\Verification\VerificationController;
use App\Http\Controllers\Verificator\VerificatorController;
use App\Http\Middleware\Auth\NonVerificatorMiddleware;
use App\Http\Middleware\Auth\SuperadminMiddleware;

Route::get('/', function () {
    return redirect()->route('autentifikasi.signin');
});

Route::controller(SigninController::class)->group(function () {
    Route::get('/signin', 'signin')->name('autentifikasi.signin')->middleware(NonAuthMiddleware::class);
});

Route::controller(VerificationController::class)->group(function () {
    Route::get('/verification/{param}', 'verificationItem')->name('verification.item');
});

Route::controller(AuthController::class)->group(function () {
    Route::post('/auth/login', 'authLogin')->name('auth.login');
    Route::post('/auth/logout', 'authLogout')->name('auth.logout');
});

Route::middleware(AuthMiddleware::class)->group(function () {
    Route::controller(MainController::class)->group(function () {
        Route::get('/dashboard/home', 'home')->name('dashboard.home');
        Route::get('/dashboard/pengguna', 'manageUser')->name('dashboard.pengguna')->middleware(SuperadminMiddleware::class);
        Route::middleware(NonVerificatorMiddleware::class)->group(function () {
            Route::get('/dashboard/guru-pegawai', 'manageOfficer')->name('dashboard.guru-pegawai');
            Route::get('/dashboard/jabatan', 'managePosition')->name('dashboard.jabatan');
            Route::get('/dashboard/ruangan', 'manageRoom')->name('dashboard.ruangan');
            Route::get('/dashboard/peminjaman', 'manageBorrowing')->name('dashboard.peminjaman');
            Route::get('/dashboard/satuan-barang', 'manageUnitItem')->name('dashboard.satuan-barang');
            Route::get('/dashboard/kondisi-barang', 'manageConditionItem')->name('dashboard.kondisi-barang');
            Route::get('/dashboard/distribusi-barang', 'manageDistributionItem')->name('dashboard.distribusi-barang');
            Route::get('/dashboard/barang', 'manageItem')->name('dashboard.barang');
        });
        Route::middleware(SuperadminMiddleware::class)->group(function () {
            Route::get('/dashboard/pengaturan', 'manageSetting')->name('dashboard.pengaturan');
            Route::post('/pengaturan/save', 'saveSetting')->name('pengaturan.save');
        });
    });
});

Route::middleware(AuthMiddleware::class, SuperadminMiddleware::class)->group(function () {
    Route::controller(UserController::class)->group(function () {
        Route::get('/pengguna/form/{param}/{id}', 'formUser')->name('pengguna.form');
        Route::post('/pengguna/save', 'saveUser')->name('pengguna.save');
        Route::delete('/pengguna/delete', 'deleteUser')->name('pengguna.delete');
    });
});

Route::middleware(AuthMiddleware::class, NonVerificatorMiddleware::class)->group(function () {
    Route::controller(PositionController::class)->group(function () {
        Route::get('/jabatan/form/{param}/{id}', 'formPosition')->name('jabatan.form');
        Route::post('/jabatan/save', 'savePosition')->name('jabatan.save');
        Route::delete('/jabatan/delete', 'deletePosition')->name('jabatan.delete');
    });
});

Route::middleware(AuthMiddleware::class, NonVerificatorMiddleware::class)->group(function () {
    Route::controller(RoomController::class)->group(function () {
        Route::get('/ruangan/form/{param}/{id}', 'formRoom')->name('ruangan.form');
        Route::post('/ruangan/save', 'saveRoom')->name('ruangan.save');
        Route::delete('/ruangan/delete', 'deleteRoom')->name('ruangan.delete');
    });
});

Route::middleware(AuthMiddleware::class, NonVerificatorMiddleware::class)->group(function () {
    Route::controller(OfficerController::class)->group(function () {
        Route::get('/pegawai/form/{param}/{id}', 'formOfficer')->name('guruPegawai.form');
        Route::post('/pegawai/save', 'saveOfficer')->name('guruPegawai.save');
        Route::delete('/pegawai/delete', 'deleteOfficer')->name('guruPegawai.delete');
    });
});

Route::middleware(AuthMiddleware::class, NonVerificatorMiddleware::class)->group(function () {
    Route::controller(ItemController::class)->group(function () {
        Route::get('/barang/form/{param}/{id}', 'formItem')->name('barang.form');
        Route::post('/barang/save', 'saveItem')->name('barang.save');
        Route::delete('/barang/delete', 'deleteItem')->name('barang.delete');
        Route::get('/barang/detail/{id}', 'detailItem')->name('barang.detail');
        Route::get('/barang/cetak-pendataan/{id}', 'printItemCollection')->name('barang.print-collection');
        Route::get('/barang/cetak-kartu/{id}', 'printItemCard')->name('barang.print-card');
    });
});

Route::middleware(AuthMiddleware::class, NonVerificatorMiddleware::class)->group(function () {
    Route::controller(UnitItemController::class)->group(function () {
        Route::get('/satuan-barang/form/{param}/{id}', 'formUnitItem')->name('satuanBarang.form');
        Route::post('/satuan-barang/save', 'saveUnitItem')->name('satuanBarang.save');
        Route::delete('/satuan-barang/delete', 'deleteUnitItem')->name('satuanBarang.delete');
    });
});

Route::middleware(AuthMiddleware::class, NonVerificatorMiddleware::class)->group(function () {
    Route::controller(ConditionItemController::class)->group(function () {
        Route::get('/kondisi-barang/form/{param}/{id}', 'formConditionItem')->name('kondisiBarang.form');
        Route::post('/kondisi-barang/save', 'saveConditionItem')->name('kondisiBarang.save');
        Route::delete('/kondisi-barang/delete', 'deleteConditionItem')->name('kondisiBarang.delete');
    });
});

Route::middleware(AuthMiddleware::class, NonVerificatorMiddleware::class)->group(function () {
    Route::controller(DistributionItemController::class)->group(function () {
        Route::get('/distribusi-barang/form/{param}/{id}', 'formDistributionItem')->name('distribusiBarang.form');
        Route::post('/distribusi-barang/save', 'saveDistributionItem')->name('distribusiBarang.save');
        Route::delete('/distribusi-barang/delete', 'deleteDistributionItem')->name('distribusiBarang.delete');
        Route::get('/distribusi-barang/detail/{id}', 'detailDistributionItem')->name('distribusiBarang.detail');
    });
});

Route::middleware(AuthMiddleware::class)->group(function () {
    Route::controller(VerificatorController::class)->group(function () {
        Route::get('/barang/verifikasi', 'itemVerified')->name('verifikator.item');
        Route::get('/barang/detail/verifikasi/{id}', 'detailItem')->name('verifikator.detail-item');
        Route::post('/barang/verified', 'changeVerified')->name('verifikator.change-verified');
    });
});
