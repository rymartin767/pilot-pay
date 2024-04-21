<?php

use App\Livewire\Report\Show;
use App\Http\Middleware\Admin;
use App\Livewire\Report\Index;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing');
})->middleware('guest')->name('landing');

Route::get('/reports', Index::class)
    ->middleware('web')
    ->name('reports.index');

Route::view('terms', 'terms-and-conditions')
    ->middleware('web')
    ->name('terms');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    // REPORTS
    Route::get('reports/{report:slug}', Show::class)->name('reports.show');

    // ADMIN
    Route::get('admin', function() {
        var_dump('admin middleware invoked');
    })->middleware(Admin::class)->name('admin');
});