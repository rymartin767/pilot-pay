<?php

use App\Models\User;
use function Pest\Laravel\actingAs;

test('landing page returns a successful response', function () {
    $this->get('/')
        ->assertStatus(200)
        ->assertViewIs('welcome');
});

test('the log in and register links are on the landing page', function () {
    $this->view('welcome')
        ->assertSee('Log in')
        ->assertSee('Register');
});

test('landing page redirects to dashboard if logged in', function() {
    actingAs(User::factory()->create())
        ->get('/')
        ->assertRedirect('dashboard');
});
