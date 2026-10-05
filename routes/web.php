<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/test', function() {
    return "hello world";
});

Route::get('/', function(Request $request) {
    
    if ($request->isjson()) {
        return $request->input('name');
    }
    return $request->role;
});

Route::get('/person/{id}', function(Request $request, int $id) {
    return view('person', ['data'=>$request->all(), 'id'=>$id]);
    });

Route::get('/teachers', function (Request $request) {
    return view('teachers');
});
