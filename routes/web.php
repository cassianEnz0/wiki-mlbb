<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HeroController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| 1. JALUR DASHBOARD (Halaman Depan)
|--------------------------------------------------------------------------
*/
Route::get('/', [HeroController::class, 'index'])->name('dashboard');


/*
|--------------------------------------------------------------------------
| 2. JALUR MEMBER (HARUS LOGIN) - TARUH DI ATAS!
|--------------------------------------------------------------------------
| Penting: Route 'create' harus dibaca duluan sebelum route 'show'
| biar kata 'create' gak dianggap sebagai nama hero.
*/
Route::middleware('auth')->group(function () {

    // >>> EXPORT EXCEL (HANYA USER LOGIN)
    Route::get('/heroes/export/excel', [HeroController::class, 'exportExcel'])
        ->name('heroes.export.excel');

    // Create
    Route::get('/heroes/create', [HeroController::class, 'create'])->name('heroes.create');
    Route::post('/heroes', [HeroController::class, 'store'])->name('heroes.store');
    
    // Edit
    Route::get('/heroes/{hero}/edit', [HeroController::class, 'edit'])->name('heroes.edit');
    Route::put('/heroes/{hero}', [HeroController::class, 'update'])->name('heroes.update');
    
    // Hapus
    Route::delete('/heroes/{hero}', [HeroController::class, 'destroy'])->name('heroes.destroy');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


/*
|--------------------------------------------------------------------------
| 3. JALUR PUBLIK (DETAIL HERO) - TARUH PALING BAWAH!
|--------------------------------------------------------------------------
| Ini ditaruh paling bawah sebagai "penangkap sisa". 
| Kalau URL-nya bukan 'create', bukan 'edit', baru dia masuk sini.
*/
Route::get('/heroes/{hero}', [HeroController::class, 'show'])->name('heroes.show');


require __DIR__.'/auth.php';
