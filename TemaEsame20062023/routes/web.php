<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

Route::get('/', [StudentController::class, 'index'])->name('student.index');
Route::get('/student/{id}', [StudentController::class, 'show'])->name('student.show'); 
Route::put('/student/{id}', [StudentController::class, 'update'])->name('student.update');
