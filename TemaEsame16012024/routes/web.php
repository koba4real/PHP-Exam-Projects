<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttivitaController;

Route::get('/', [AttivitaController::class, 'index']);
Route::get('/attivita/create', [AttivitaController::class, 'create']);
// Route to handle the form submission and store the new task
Route::post('/tasks', [AttivitaController::class, 'store'])->name('tasks.store');

// Route to display all tasks (assuming you have one, used by your "Annulla" button)
Route::get('/tasks', [AttivitaController::class, 'index'])->name('tasks.index');
Route::delete('/tasks/{id}', [AttivitaController::class, 'destroy'])->name('tasks.destroy');
Route::patch('/tasks/{id}/toggle', [AttivitaController::class, 'update'])->name('tasks.update');


