<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SquadraController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/classifica', [SquadraController::class, 'index'])->name('classifica');
    Route::post('/init', [SquadraController::class, 'init'])->name('init');
    Route::post('/reset', [SquadraController::class, 'reset'])->name('reset');
    Route::get('/punteggio-medio', [SquadraController::class, 'punteggioMedio'])->name('punteggio.medio');
});

require __DIR__.'/auth.php';
