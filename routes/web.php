<?php

use App\Http\Controllers\KuisController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\TestimoniController;
use App\Http\Controllers\TutorController;
use App\Models\Kuis;
use App\Models\Program;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Landing page keseluruhan
// Route::get('/', function () {
//     return view('home');
// });
Route::get('/', [TutorController::class, 'index'])->name('programs', 'tutors');
// Route::get('/', [ProgramController::class, 'view'])->name('programs');
Route::get('/program', [ProgramController::class, 'index'])->name('programs');
Route::get('/detail/{id}', [ProgramController::class, 'detail'])->name('program');


// ==ROUTE BERDASARKAN LEVEL==
// Route siswa
Route::middleware(['auth', 'level:3'])->prefix('siswa')->name('siswa.')->group(function(){
    Route::get('/', [SiswaController::class, 'index'])->name('siswa');
    Route::get('/setting', [SiswaController::class, 'edit'])->name('setting');
    Route::patch('/setting/{id}', [SiswaController::class, 'update'])->name('setting.update');
    
    Route::get('/detail/{id}', [ProgramController::class, 'detailSiswa'])->name('detailProgram');
    Route::get('/checkout/{id}', [PendaftaranController::class, 'checkout'])->name('checkoutProgram');
    Route::post('/pendaftaran', [PendaftaranController::class, 'pendaftaran'])->name('pendaftaran');
    Route::get('/thankyou', [PendaftaranController::class, 'thankyou'])->name('thankyou');
    
    Route::get('/transaksi', [PendaftaranController::class, 'transaksi'])->name('transaksi');
    Route::get('/transaksi/{id}', [PendaftaranController::class, 'transaksiDetail'])->name('transaksi.detail-transaksi');
    Route::get('/transaksi/{id}/cetakInvoice', [PendaftaranController::class, 'cetakInvoice'])->name('transaksi.cetakInvoice');
    
    Route::get('/kuis', [KuisController::class, 'index'])->name('kuis');
    Route::get('/kuis/{id}', [KuisController::class, 'detailKuis'])->name('detail-kuis');
    Route::post('/kuis/{id}/submit', [KuisController::class, 'submit'])->name('kuis.submit');
    Route::get('/kuis/{id}/hasil', [KuisController::class, 'hasil'])->name('kuis.hasil');
   
    Route::get('/program', [ProgramController::class, 'programSiswa'])->name('program');
    Route::prefix('program')->group(function(){
        Route::get('/testimoni', [TestimoniController::class, 'index'])->name('program.testimoni');
        Route::post('/testimoni', [TestimoniController::class, 'store'])->name('program.testimoni.store');
    });
});

// Hal profil user setelah login
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
