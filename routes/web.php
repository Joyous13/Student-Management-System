<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentFileController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\ClassController;

Route::get('/', function() {
    return redirect()->route('auth');
});

Route::get('/auth', function () {
    return view('auth.auth');
})->name('auth');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Students CRUD
    Route::resource('students', StudentController::class);

    // Custom student view
    Route::get('/students-view/{id}', [StudentController::class, 'display'])->name('students.display');

    // Student file uploads
    Route::post('/students/{student}/files', [StudentFileController::class, 'store'])->name('students.files.store');
    Route::get('/students/files/{file}/download', [StudentFileController::class, 'download'])->name('students.files.download');
    Route::delete('/students/files/{file}', [StudentFileController::class, 'destroy'])->name('students.files.destroy');

    // Exams
    Route::post('/students/{student}/exams', [ExamController::class,'store'])->name('students.exams.store');
    Route::put('/exams/{exam}', [ExamController::class,'update'])->name('exams.update');
    Route::delete('/exams/{exam}', [ExamController::class,'destroy'])->name('exams.destroy');

    // Export
    Route::get('/export/{format?}', [ExportController::class,'export'])->name('export.students');

    // Classes CRUD
    Route::resource('classes', ClassController::class);

});

require __DIR__.'/auth.php';
