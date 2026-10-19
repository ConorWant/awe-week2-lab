<?php

use App\Http\Controllers\PersonController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function (Request $request) {

    return view('welcome');
})->name('welcome');

Route::get('/teachers', function (Request $request) {
    return view('teachers');
})->name('teachers.index');

Route::get('/departments', function (Request $request) {
    return view('departments');
})->name('departments.index');

Route::resource('people', PersonController::class)->only([
    'index',
    'create',
    'store',
    'show',
]);
