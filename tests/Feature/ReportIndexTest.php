<?php

use App\Models\User;
use function Pest\Laravel\actingAs;

test('report index page middleware', function () {
    $this->get('/reports')
        ->assertStatus(200);
});

test('the log in and register links are on the report index page', function () {
    $this->view('landing')
        ->assertSee('Log in')
        ->assertSee('Register');
});
