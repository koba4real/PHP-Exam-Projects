<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ArticoloController;
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
    Route::get('/articoli', [ArticoloController::class, 'index'])->name('articoli.index'); // È buona pratica dare un nome alle rotte
    Route::get('/articoli/{articolo}/autori', [ArticoloController::class, 'getAuthorsDetails'])->name('articoli.authors.details');
});

require __DIR__.'/auth.php';
