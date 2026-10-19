<?php

use App\Http\Controllers\TeacherController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function (Request $request) {

    return view('welcome');
})->name('welcome');

Route::get('/teachers', [TeacherController::class, 'index'])->name('teachers.index');

Route::get('/departments', function (Request $request) {
    return view('departments');
})->name('departments.index');

Route::get('/teachers/create', [TeacherController::class, 'create'])->name('teachers.create');
Route::post('/teachers', [TeacherController::class, 'store'])->name('teachers.store');
Route::get('/teachers/{teacher}/edit', [TeacherController::class, 'edit'])->name('teachers.edit');
Route::put('/teachers/{teacher}', [TeacherController::class, 'update'])->name('teachers.update');
