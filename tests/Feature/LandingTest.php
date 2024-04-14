<?php

use App\Models\User;
use function Pest\Laravel\actingAs;

test('landing page returns a successful response', function () {
    $this->get('/')
        ->assertStatus(200)
        ->assertViewIs('landing');
});

test('the log in and register links are on the landing page', function () {
    $this->view('landing')
        ->assertSee('Reports')
        ->assertSee('Register');
});

test('landing page redirects to reports if logged in', function() {
    actingAs(User::factory()->create())
        ->get('/')
        ->assertRedirect('reports');
});
