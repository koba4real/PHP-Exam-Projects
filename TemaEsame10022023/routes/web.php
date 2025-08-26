<?php

use App\Http\Controllers\VotoController;
use Illuminate\Support\Facades\Route;

Route::get('/', [VotoController::class, 'index'])->name('voti.index');
Route::post('/voti', [VotoController::class, 'store'])->name('voti.store');
Route::post('/voti/destroy', [VotoController::class, 'destroyAll'])->name('voti.destroyAll');
