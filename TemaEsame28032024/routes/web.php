<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LucidiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');;

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    
});
Route::middleware(['auth', 'isProfessor'])->prefix('professor')->group(function () { // <-- Removed 'middleware:' keyword, it's not needed here
    Route::get('/lucidis', [LucidiController::class, 'index'])->name('lucidis.index');
    Route::get('/lucidis/create', [LucidiController::class, 'create'])->name('lucidis.create');
    Route::post('/lucidis/store', [LucidiController::class, 'store'])->name('lucidis.store');
    Route::delete('/lucidis/{id}', [LucidiController::class, 'destroy'])->name('lucidis.destroy');
   
});
Route::middleware(['auth', 'isStudent'])->prefix('student')->group(function () {
    Route::get('/lucidis', [LucidiController::class, 'show'])->name('lucidis.show');
    
});

require __DIR__.'/auth.php';
