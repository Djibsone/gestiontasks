<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

/*Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route pour les tâches
Route::prefix('/taches')->name('tasks.')->middleware('auth')->controller(TaskController::class)->group(function () {
    Route::get('/', 'index')->name('dashboard');
    Route::get('/create', 'show')->name('show');
    Route::post('/create', 'store')->name('store');
    Route::get('/edit/{id}', 'edit')->name('edit');
    Route::put('/edit/{task}', 'update')->name('update');
    Route::delete('destroy/{id}', 'destroy')->name('destroy');
});

require __DIR__.'/auth.php';
