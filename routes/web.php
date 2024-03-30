<?php

use App\Livewire\Report\Show;
use App\Livewire\Report\Index;
use App\Models\Report;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing');
})->middleware('guest');

Route::get('/reports', Index::class)
    ->middleware('web')
    ->name('reports.index');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    // REPORTS
    Route::get('reports/{report:slug}', Show::class)->name('reports.show');
});
