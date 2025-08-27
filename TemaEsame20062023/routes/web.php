<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

Route::get('/', [StudentController::class, 'index'])->name('student.index');
Route::get('/studenti/{id}', [StudentController::class, 'show'])->name('student.show');
