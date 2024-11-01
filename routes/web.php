<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GajiController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UpdatePasswordController;

Route::get('/', function () {
    return view('dashboard');
})->middleware('auth');

Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login-process', [LoginController::class, 'authentication'])->name('login.process');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('user/registration', [LoginController::class, 'registration'])->name('user.registration')->middleware('auth');
Route::post('user/store', [LoginController::class, 'store'])->name('user.store')->middleware('auth');

Route::get('profile', [LoginController::class, 'profile'])->name('user.profile')->middleware('auth');
Route::put('profile', [LoginController::class, 'update'])->name('user.update')->middleware('auth');

Route::get('password/edit', [UpdatePasswordController::class, 'edit'])->name('password.edit')->middleware('auth');
Route::put('password/update', [UpdatePasswordController::class, 'update'])->name('password.update')->middleware('auth');

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

Route::get('karyawan', [KaryawanController::class, 'index'])->name('karyawan.index')->middleware('auth');
Route::get('karyawan/create', [KaryawanController::class, 'create'])->name('karyawan.create')->middleware('auth');
Route::post('karyawan/store', [KaryawanController::class, 'store'])->name('karyawan.store')->middleware('auth');
Route::get('/karyawan/{id}/edit', [KaryawanController::class, 'edit'])->name('karyawan.edit')->middleware('auth');
Route::put('/karyawan/{id}', [KaryawanController::class, 'update'])->name('karyawan.update')->middleware('auth');
Route::delete('/karyawan/{id}', [KaryawanController::class, 'destroy'])->name('karyawan.destroy')->middleware('auth');


Route::get('/gaji/index', [GajiController::class, 'index'])->name('gaji.index')->middleware('auth');
Route::get('/gaji/create', [GajiController::class, 'create'])->name('gaji.create')->middleware('auth');
Route::post('/gaji', [GajiController::class, 'store'])->name('gaji.store')->middleware('auth');
Route::get('/gaji/{id}/edit', [GajiController::class, 'edit'])->name('gaji.edit')->middleware('auth');
Route::put('/gaji/{id}', [GajiController::class, 'update'])->name('gaji.update')->middleware('auth');
Route::delete('/gaji/{id}', [GajiController::class, 'destroy'])->name('gaji.destroy')->middleware('auth');

Route::get('gaji/rekap', [GajiController::class, 'rekapgaji'])->name('gaji.rekap')->middleware('auth');
Route::get('/gaji/filter-by-date', [GajiController::class, 'filterByDate'])->middleware('auth');
Route::get('/gaji/cetakrekap', [GajiController::class, 'cetakrekap'])->name('gaji.cetakrekap')->middleware('auth');
