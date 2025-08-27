<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttivitaController;

Route::get('/', [AttivitaController::class, 'index']);
