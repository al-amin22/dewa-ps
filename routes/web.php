<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Transaksi Routes
    Route::resource('transaksi', TransaksiController::class);
    // routes/web.php
    Route::get('/transaksi/get/{bulan}/{tahun}', [TransaksiController::class, 'getByBulanTahun']);
    // Pengeluaran Routes
    Route::resource('pengeluaran', PengeluaranController::class);

    // Export Routes
    Route::get('/export/excel', [ExportController::class, 'exportExcel']);
    Route::get('/export/pdf', [DashboardController::class, 'exportPDF'])->name('export.pdf');
});
