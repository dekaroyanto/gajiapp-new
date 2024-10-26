<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GajiController;
use App\Http\Controllers\KaryawanController;

Route::get('/', function () {
    return view('user.login');
});



Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('karyawan', [KaryawanController::class, 'index'])->name('karyawan.index');
Route::get('karyawan/create', [KaryawanController::class, 'create'])->name('karyawan.create');
Route::post('karyawan/store', [KaryawanController::class, 'store'])->name('karyawan.store');
Route::get('/karyawan/{id}/edit', [KaryawanController::class, 'edit'])->name('karyawan.edit');
Route::put('/karyawan/{id}', [KaryawanController::class, 'update'])->name('karyawan.update');
Route::delete('/karyawan/{id}', [KaryawanController::class, 'destroy'])->name('karyawan.destroy');


Route::get('/gaji/index', [GajiController::class, 'index'])->name('gaji.index');
Route::get('/gaji/create', [GajiController::class, 'create'])->name('gaji.create');
Route::post('/gaji', [GajiController::class, 'store'])->name('gaji.store');
Route::get('/gaji/{id}/edit', [GajiController::class, 'edit'])->name('gaji.edit');
Route::put('/gaji/{id}', [GajiController::class, 'update'])->name('gaji.update');
Route::delete('/gaji/{id}', [GajiController::class, 'destroy'])->name('gaji.destroy');
