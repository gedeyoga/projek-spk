<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KriteriaController;

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
    Route::get('kriteria' , [KriteriaController::class, 'index'])->name('kriteria.index');
    Route::get('kriteria/create' , [KriteriaController::class, 'create'])->name('kriteria.create');
    Route::post('kriteria/store' , [KriteriaController::class, 'store'])->name('kriteria.store');
    Route::get('kriteria/{kriteria}/edit' , [KriteriaController::class, 'edit'])->name('kriteria.edit');
    Route::put('kriteria/{kriteria}/update' , [KriteriaController::class, 'update'])->name('kriteria.update');
    Route::delete('kriteria/{kriteria}' , [KriteriaController::class, 'destroy'])->name('kriteria.delete');
});
