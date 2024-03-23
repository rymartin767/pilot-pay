<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing');
})->middleware('guest');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/reports', function () {
        return view('reports.index');
    })->name('reports.index');
});
