<?php

use App\Http\Controllers\admin\AuthController;
use App\Http\Controllers\admin\dashboardController;
use App\Http\Controllers\admin\parentController;
use App\Http\Controllers\admin\teacherController;
use App\Http\Controllers\student\studentController;
use App\Http\Middleware\admin;
use Illuminate\Support\Facades\Route;



Route::prefix('')->group(function () {
    Route::get('/', [AuthController::class, 'signin'])->name('signin');
    Route::post('/', [AuthController::class, 'login'])->name('login');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
})->middleware('guest');



Route::prefix('/dashboard')->group(function () {
    Route::get('/', [dashboardController::class, 'index'])->name('dashboard');

    Route::get('/students', [studentController::class, 'index'])->name('students');
    Route::get('/students/create', [studentController::class, 'create'])->name('students.create');
    Route::post('/students/store', [studentController::class, 'store'])->name('students.store');
    Route::get('/students/edit/{student}', [studentController::class, 'edit'])->name('students.edit');
    Route::post('/students/update/{student}', [studentController::class, 'update'])->name('students.update');
    Route::delete('/students/delete/{student}', [studentController::class, 'delete'])->name('students.delete');

    Route::get('/admin/students/all/parents', [parentController::class, 'index'])->name('parents');
    Route::get('/admin/students/{student}/add-parent', [parentController::class, 'addParent'])->name('students.addParent');
    Route::post('/admin/students/{student}/add-parent', [parentController::class, 'storeParent'])->name('students.store.parent');
    Route::get('/admin/students/all/parents/{parent}/edit', [parentController::class, 'edit'])->name('parents.edit');
    Route::post('/admin/students/all/parents/{parent}/update', [parentController::class, 'update'])->name('parents.update');
    Route::delete('/admin/students/all/parents/{parent}/delete', [parentController::class, 'delete'])->name('parents.delete');

    Route::get('/teachers', [teacherController::class, 'index'])->name('teachers');
    Route::get('/teachers/create', [teacherController::class, 'create'])->name('teachers.create');
    Route::post('/teachers/store', [teacherController::class, 'store'])->name('teachers.store');
    Route::get('/teachers/edit/{teacher}', [teacherController::class, 'edit'])->name('teachers.edit');
    Route::post('/teachers/update/{teacher}', [teacherController::class, 'update'])->name('teachers.update');
    Route::delete('/teachers/delete/{teacher}', [teacherController::class, 'delete'])->name('teachers.delete');
})->middleware(['auth', admin::class]);
