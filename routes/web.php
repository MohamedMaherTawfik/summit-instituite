<?php

use App\Http\Controllers\accountant\financialController;
use App\Http\Controllers\admin\AuthController;
use App\Http\Controllers\admin\ClassesController;
use App\Http\Controllers\admin\courseController;
use App\Http\Controllers\admin\dashboardController;
use App\Http\Controllers\admin\parentController;
use App\Http\Controllers\admin\teacherController;
use App\Http\Controllers\student\studentController;
use App\Http\Controllers\teacher\attendanceController;
use App\Http\Middleware\admin;
use Illuminate\Support\Facades\Route;



Route::prefix('')->group(function () {
    Route::get('/', [AuthController::class, 'signin'])->name('signin');
    Route::post('/', [AuthController::class, 'login'])->name('login');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
})->middleware('guest');

Route::prefix('/dashboard')->middleware(['auth', admin::class])->group(function () {
    Route::get('/', [dashboardController::class, 'index'])->name('dashboard');

    Route::get('/students', [studentController::class, 'index'])->name('students');
    Route::get('/students/attendances/{student}', [studentController::class, 'attendances'])->name('students.attendances');
    Route::get('/students/installments/{student}', [studentController::class, 'installments'])->name('students.installments');
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

    Route::get('/classes', [ClassesController::class, 'index'])->name('classes');
    Route::post('/classes/create/store', [ClassesController::class, 'store'])->name('classes.store');
    Route::post('/classes/edit/{class}', [ClassesController::class, 'update'])->name('classes.update');
    Route::delete('/classes/delete/{class}', [ClassesController::class, 'delete'])->name('classes.delete');

    Route::get('/attendances', [attendanceController::class, 'index'])->name('attendances');
    Route::get('/attendances/create', [attendanceController::class, 'index'])->name('attendances.create');
    Route::post('/attendances/store', [attendanceController::class, 'store'])->name('attendances.store');
    Route::delete('/attendances/delete/{attendance}', [attendanceController::class, 'delete'])->name('attendances.delete');

    Route::get('/financials', [financialController::class, 'index'])->name('financials');
    Route::get('/financials/installments', [financialController::class, 'installments'])->name('financials.installments');
    Route::get('/financials/create', [financialController::class, 'create'])->name('financials.create');
    Route::post('/financials/store', [financialController::class, 'store'])->name('financials.store');
    Route::get('/financials/edit/{financial}', [financialController::class, 'edit'])->name('financials.edit');
    Route::post('/financials/update/{financial}', [financialController::class, 'update'])->name('financials.update');
    Route::delete('/financials/delete/{financial}', [financialController::class, 'delete'])->name('financials.delete');

    Route::get('/courses', [courseController::class, 'index'])->name('courses');
    Route::post('/courses/store', [courseController::class, 'store'])->name('courses.store');
    Route::post('/courses/update/{course}', [courseController::class, 'update'])->name('courses.update');
    Route::delete('/courses/delete/{course}', [courseController::class, 'delete'])->name('courses.delete');

});
