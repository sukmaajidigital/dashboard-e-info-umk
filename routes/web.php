<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
Route::get('/dashboard/data', [DashboardController::class, 'getData'])->name('dashboard.data');
Route::get('/dashboard/fakultas', [DashboardController::class, 'getFakultas'])->name('dashboard.fakultas');
Route::get('/dashboard/prodi', [DashboardController::class, 'getProdi'])->name('dashboard.prodi');
Route::get('/dashboard/matakuliah', [DashboardController::class, 'getMatakuliah'])->name('dashboard.matakuliah');
Route::get('/dashboard/filter', [DashboardController::class, 'filter'])->name('dashboard.filter');
