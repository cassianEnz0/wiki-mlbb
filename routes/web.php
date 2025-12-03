<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HeroController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HeroController::class, 'index'])->name('dashboard');

Route::middleware('auth')->group(function () {

    // >>> EXPORT EXCEL
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

Route::get('/heroes/{hero}', [HeroController::class, 'show'])->name('heroes.show');


require __DIR__.'/auth.php';

