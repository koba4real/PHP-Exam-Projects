<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransazioneController;

Route::get('/', [TransazioneController::class, 'index']);
Route::resource('/transazioni', TransazioneController::class);
