<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\StudentsModelController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

   /* Students */
    Route::get('/studentsdashboard', [StudentsModelController::class, 'index'])->name('studentsdashboard.index');
    Route::post('/addStudent', [StudentsModelController::class, 'store'])->name('addStudent.store');
    Route::patch('/updateStudent/{id}', [StudentsModelController::class, 'update'])->name('updateStudent.update');
    Route::delete('/deleteStudent/{id}', [StudentsModelController::class, 'destroy'])->name('deleteStudent.destroy');
});

require __DIR__.'/auth.php';
