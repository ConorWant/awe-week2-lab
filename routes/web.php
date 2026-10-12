<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\ProductController;


Route::get('/test', function() {
    return "hello world";
});

Route::get('/', function(Request $request) {
    
    return view ('welcome');
})->name('welcome');

Route::get('/person/{id}', function(Request $request, int $id) {
    return view('person', ['data'=>$request->all(), 'id'=>$id]);
    });

Route::get('/teachers', function (Request $request) {
    return view('teachers');
})->name('teachers.index');

Route::get('/product', [ProductController::class, 'index']);
Route::get('/product/{id}', [ProductController::class, 'show']);
