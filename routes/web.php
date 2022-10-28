<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\AngkatanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\RfidController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
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
    return view('auth.login');
});

Auth::routes();

Route::middleware('auth')->group(function () {
    // Route Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');
    Route::post('/profile', [DashboardController::class, 'update'])->name('profile.update');

    // Data Master
    // Route User
    Route::resource('users', UserController::class);
    // Route Jurusan
    Route::resource('jurusan', JurusanController::class);
    // Route Angkatan
    Route::resource('angkatan', AngkatanController::class);
    // Route Jadwal
    Route::resource('jadwal', JadwalController::class);
    // Route Siswa
    Route::resource('siswa', SiswaController::class);

    // Data Devices
    // Route Device
    Route::resource('device', DeviceController::class);
    // Route Rfid
    Route::resource('rfid', RfidController::class);
    // Route History
    Route::resource('history', HistoryController::class);

    // Route Absensi
    Route::get('/absensi/export', [AbsensiController::class, 'export'])->name('absensi.export');
    Route::get('/absensi/rekap', [AbsensiController::class, 'rekap'])->name('absensi.rekap');
    Route::resource('absensi', AbsensiController::class);
});


// Route Install
Route::get('/exec', function () {
    Artisan::call('key:generate');
    Artisan::call('migrate:fresh');
    Artisan::call('db:seed');
});
