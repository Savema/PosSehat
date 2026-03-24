<?php

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnakController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EdukasiController;
use App\Http\Controllers\IbuHamilController;
use App\Http\Controllers\PengukuranBalitaController;
use App\Http\Controllers\PengukuranIbuHamilController;
use App\Http\Controllers\UsersController;

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

Route::get('/', function () {
    return view('landingPage.index');
});

// Route::get('/register', [AuthController::class, 'showRegister']);
// Route::get('/login', [AuthController::class, 'showLogin']);

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/proseslogin', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::resource('balita', AnakController::class);
});

Route::middleware(['auth'])->group(function () {
    Route::resource('ibu_hamil', IbuHamilController::class);
});

Route::middleware(['auth'])->group(function () {
    Route::resource('edukasi', EdukasiController::class);
});

Route::middleware(['auth','role:admin'])->group(function () {
    Route::resource('users', UsersController::class);
});

Route::middleware(['auth'])->group(function () {
    Route::resource('pengukuran_ibu_hamil', PengukuranIbuHamilController::class);
});

Route::get('/pengukuran-ibu-hamil/{id}/detail',
    [PengukuranIbuHamilController::class, 'detail'])
    ->name('pengukuran_ibu_hamil.detail');

Route::post('/cetak-ibu-hamil/{id}', [PengukuranIbuHamilController::class, 'cetakPdf']);

Route::middleware(['auth'])->group(function () {
    Route::resource('pengukuran_balita', PengukuranBalitaController::class);
});

Route::get('/pengukuran-balita/{id}/detail',
    [PengukuranBalitaController::class, 'detail'])
    ->name('pengukuran_balita.detail');

Route::post('/cetak-balita/{id}', [PengukuranBalitaController::class, 'cetakPdf']);

