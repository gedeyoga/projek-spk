<?php

use App\Http\Controllers\AlternatifController;
use App\Http\Controllers\BarsController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CriticalIncidentController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\NilaiKriteriaController;
use App\Http\Controllers\PerformanceController;
use App\Http\Controllers\PerhitunganController;

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


Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // Kriteria
    Route::get('/kriteria', [KriteriaController::class, 'index'])->name('kriteria.index');
    Route::get('/kriteria/create', [KriteriaController::class, 'create'])->name('kriteria.create');
    Route::post('/kriteria/store', [KriteriaController::class, 'store'])->name('kriteria.store');
    Route::get('/kriteria/{kriteria}/edit', [KriteriaController::class, 'edit'])->name('kriteria.edit');
    Route::put('/kriteria/{kriteria}/update', [KriteriaController::class, 'update'])->name('kriteria.update');
    Route::delete('kriteria/{kriteria}', [KriteriaController::class, 'destroy'])->name('kriteria.delete');

    // nilai kriteria
    Route::get('/nilai-kriteria', [NilaiKriteriaController::class, 'index'])->name('nilai-kriteria.index');
    Route::post('/nilai-kriteria/store', [NilaiKriteriaController::class, 'store'])->name('nilai-kriteria.store');
    Route::get('/nilai-kriteria/{kriteria}/edit', [NilaiKriteriaController::class, 'edit'])->name('nilai-kriteria.edit');
    Route::put('/nilai-kriteria/{kriteria}/update', [NilaiKriteriaController::class, 'update'])->name('nilai-kriteria.update');
    Route::delete('/nilai-kriteria/{kriteria}', [NilaiKriteriaController::class, 'destroy'])->name('nilai-kriteria.delete');


    // user
    Route::get('/user', [UserController::class, 'index'])->name('user.index');

    Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
    Route::get('/user/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');
    Route::put('/profile/{user}', [UserController::class, 'updateProfile'])->name('user.updateProfile');
    Route::put('/user/{user}/update', [UserController::class, 'update'])->name('user.update');
    Route::delete('/user/{user}', [UserController::class, 'destroy'])->name('user.delete');

    // alternatif
    Route::get('/alternatif', [AlternatifController::class, 'index'])->name('alternatif.index');
    Route::get('/alternatif/create', [AlternatifController::class, 'create'])->name('alternatif.create');
    Route::post('/alternatif/store', [AlternatifController::class, 'store'])->name('alternatif.store');
    Route::get('/alternatif/{alternatif}/edit}', [AlternatifController::class, 'edit'])->name('alternatif.edit');
    Route::put('/alternatif/{alternatif}/edit}', [AlternatifController::class, 'update'])->name('alternatif.update');
    Route::delete('/alternatif/{alternatif}', [AlternatifController::class, 'destroy'])->name('alternatif.delete');

    // Perhitungan
    Route::get('/perhitungan', [PerhitunganController::class, 'index'])->name('perhitungan.index');
    Route::post('/perhitungan/save', [PerhitunganController::class, 'saveRecordPerhitungan'])->name('perhitungan.save');

    // Laporan
    Route::get('/laporan/ranking', [LaporanController::class, 'laporanRanking'])->name('laporan.ranking');
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');

    //Company
    Route::get('/setting', [CompanyController::class, 'edit'])->name('company.edit');
    Route::put('/setting/{company}/update', [CompanyController::class, 'update'])->name('company.update');

    //Bars
    Route::get('/bars/critical-incident', [CriticalIncidentController::class, 'index'])->name('bars.critical-incident');
    Route::post('/bars/critical-incident', [CriticalIncidentController::class, 'store'])->name('bars.critical-incident.store');
    Route::get('/bars/critical-incident/{critical}', [CriticalIncidentController::class, 'show'])->name('bars.critical-incident.show');
    Route::put('/bars/critical-incident/{critical}', [CriticalIncidentController::class, 'update'])->name('bars.critical-incident.update');
    Route::delete('/bars/critical-incident/{critical}', [CriticalIncidentController::class, 'destroy'])->name('bars.critical-incident.destroy');

    Route::get('/bars/performance', [PerformanceController::class, 'index'])->name('bars.performance');
    Route::post('/bars/performance', [PerformanceController::class, 'store'])->name('bars.performance.store');
    Route::get('/bars/performance/{performance}', [PerformanceController::class, 'show'])->name('bars.performance.show');
    Route::put('/bars/performance/{performance}', [PerformanceController::class, 'update'])->name('bars.performance.update');
    Route::delete('/bars/performance/{performance}', [PerformanceController::class, 'destroy'])->name('bars.performance.destroy');

    Route::get('/bars/final-instrument', [BarsController::class, 'index'])->name('bars.final-instrument');
});
