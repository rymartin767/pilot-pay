<?php

use App\Models\User;
use function Pest\Laravel\actingAs;

test('filament dashboard is not available to guest', function () {
    $this->get('/dashboard')
        ->assertStatus(302)
        ->assertRedirect('/dashboard/login');
});

test('filament dashboard is available to auth users', function () {
    actingAs(User::factory()->create())
        ->get('/dashboard')
        ->assertStatus(200);
});

test('panel only show earnings tab if earnings exist for a user', function () {
    actingAs(User::factory()->create())
        ->get('/dashboard')
        ->assertStatus(200);
})->todo();