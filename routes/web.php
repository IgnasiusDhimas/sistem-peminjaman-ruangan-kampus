<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\User\PeminjamanUserController;
use App\Http\Controllers\Admin\PeminjamanAdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\GedungController;
use App\Http\Controllers\Petugas\PeminjamanPetugasController;
use App\Http\Controllers\RuangController;

/*
|--------------------------------------------------------------------------
| Halaman Awal
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| PROFIL USER
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| DASHBOARD ROLE
|--------------------------------------------------------------------------
*/
Route::middleware(['auth','role:admin'])
    ->get('/admin/dashboard', [DashboardController::class, 'admin'])
    ->name('admin.dashboard');

Route::middleware(['auth','role:petugas'])
    ->get('/petugas/dashboard', [DashboardController::class, 'petugas'])
    ->name('petugas.dashboard');

Route::middleware(['auth','role:user'])
    ->get('/user/dashboard', [DashboardController::class, 'user'])
    ->name('user.dashboard');

/*
|--------------------------------------------------------------------------
| AJAX GLOBAL → dipindah dari middleware biar tidak error
|--------------------------------------------------------------------------
*/



/*
|--------------------------------------------------------------------------
| ADMIN – Kelola Peminjaman
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/admin/peminjaman', [PeminjamanAdminController::class, 'index'])
        ->name('admin.peminjaman.index');

    Route::get('/admin/peminjaman/create', [PeminjamanAdminController::class, 'create'])
        ->name('admin.peminjaman.create');

    Route::post('/admin/peminjaman/store', [PeminjamanAdminController::class, 'store'])
        ->name('admin.peminjaman.store');

    Route::get('/admin/peminjaman/{id}', [PeminjamanAdminController::class, 'detail'])
        ->name('admin.peminjaman.detail');

    Route::post('/admin/peminjaman/{id}/approve', [PeminjamanAdminController::class, 'approve'])
        ->name('admin.peminjaman.approve');

    Route::post('/admin/peminjaman/{id}/reject', [PeminjamanAdminController::class, 'reject'])
        ->name('admin.peminjaman.reject');

    Route::get('/admin/peminjaman/{id}/edit', [PeminjamanAdminController::class, 'edit'])
        ->name('admin.peminjaman.edit');

    Route::put('/admin/peminjaman/{id}', [PeminjamanAdminController::class, 'update'])
        ->name('admin.peminjaman.update');

    Route::delete('/admin/peminjaman/{id}', [PeminjamanAdminController::class, 'destroy'])
        ->name('admin.peminjaman.delete');


    /*
    |--------------------------------------------------------------------------
    | ADMIN USER
    |--------------------------------------------------------------------------
    */
    Route::prefix('admin/user')->name('admin.user.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/store', [UserController::class, 'store'])->name('store');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit');
        Route::put('/{user}', [UserController::class, 'update'])->name('update');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | ADMIN GEDUNG
    |--------------------------------------------------------------------------
    */
    Route::prefix('admin/gedung')->name('admin.gedung.')->group(function () {
        Route::get('/', [GedungController::class, 'index'])->name('index');
        Route::get('/create', [GedungController::class, 'create'])->name('create');
        Route::post('/store', [GedungController::class, 'store'])->name('store');
        Route::get('/{gedung}/edit', [GedungController::class, 'edit'])->name('edit');
        Route::put('/{gedung}', [GedungController::class, 'update'])->name('update');
        Route::delete('/{gedung}', [GedungController::class, 'destroy'])->name('destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | ADMIN RUANG
    |--------------------------------------------------------------------------
    */
    Route::prefix('admin/ruang')->name('admin.ruang.')->group(function () {
        Route::get('/', [RuangController::class, 'index'])->name('index');
        Route::get('/create', [RuangController::class, 'create'])->name('create');
        Route::post('/store', [RuangController::class, 'store'])->name('store');
        Route::get('/{ruang}/edit', [RuangController::class, 'edit'])->name('edit');
        Route::put('/{ruang}', [RuangController::class, 'update'])->name('update');
        Route::delete('/{ruang}', [RuangController::class, 'destroy'])->name('destroy');
    });

    Route::get('/admin/ajax/ruangan', [PeminjamanAdminController::class, 'getRuangan'])
    ->name('admin.ajax.ruangan');


});

/*
|--------------------------------------------------------------------------
| USER – Peminjaman
|--------------------------------------------------------------------------
*/
Route::middleware(['auth','role:user'])->group(function () {
    Route::get('/peminjaman', [PeminjamanUserController::class, 'index'])
        ->name('user.peminjaman.index');

    Route::get('/peminjaman/create', [PeminjamanUserController::class, 'create'])
        ->name('user.peminjaman.create');

    Route::post('/peminjaman', [PeminjamanUserController::class, 'store'])
        ->name('user.peminjaman.store');

    Route::get('/ajax/ruangan', [PeminjamanUserController::class, 'getRuangan'])
    ->name('ajax.ruangan');
});

/*
|--------------------------------------------------------------------------
| PETUGAS – Kelola Peminjaman
|--------------------------------------------------------------------------
*/
Route::middleware(['auth','role:petugas'])->group(function () {

    Route::get('/petugas/peminjaman', [PeminjamanPetugasController::class, 'index'])
        ->name('petugas.peminjaman.index');

    Route::get('/petugas/peminjaman/create', [PeminjamanPetugasController::class, 'create'])
        ->name('petugas.peminjaman.create');

    Route::post('/petugas/peminjaman/store', [PeminjamanPetugasController::class, 'store'])
        ->name('petugas.peminjaman.store');

    Route::get('/petugas/peminjaman/{id}', [PeminjamanPetugasController::class, 'detail'])
        ->name('petugas.peminjaman.detail');

    Route::post('/petugas/peminjaman/{id}/approve', [PeminjamanPetugasController::class, 'approve'])
        ->name('petugas.peminjaman.approve');

    Route::post('/petugas/peminjaman/{id}/reject', [PeminjamanPetugasController::class, 'reject'])
        ->name('petugas.peminjaman.reject');

    Route::get('/ajax/ruang/{gedung_id}', function ($gedung_id) {
        return \App\Models\Ruang::where('gedung_id', $gedung_id)->get();
    })->name('ajax.ruang');
});

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';
