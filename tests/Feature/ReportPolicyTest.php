<?php

use App\Models\User;
use App\Models\Report;
use App\Models\Earning;
use App\Policies\ReportPolicy;
use function Pest\Laravel\actingAs;

it('allows users to view reports they are authorized to view', function () {
    $user = User::factory()->create();
    $report = Report::factory()->create(['user_id' => $user->id]);

    $policy = new ReportPolicy();

    expect($policy->view($user, $report))->toBe(true);
});

it('allows authenticated users to view reports', function () {
    actingAs(User::factory()->create());

    $report = Report::factory()->has(Earning::factory())->create();
    $this->actingAs($report->user)->get(route('reports.show', $report))
         ->assertStatus(200);
});

it('does not allow guests to view a report show page', function () {
    // Attempt to view a report without authenticating
    $report = Report::factory()->create();
    $this->get(route('reports.show', $report))
         ->assertStatus(302);
});

it('allows users to update reports they own', function () {
    $user = User::factory()->create();
    $report = Report::factory()->create(['user_id' => $user->id]);

    $policy = new ReportPolicy();

    expect($policy->update($user, $report))->toBe(true);
});

it('denies users to update reports they do not own', function () {
    $user = User::factory()->create();
    $otherUser = User::factory()->create();
    $report = Report::factory()->create(['user_id' => $otherUser->id]);

    $policy = new ReportPolicy();

    expect($policy->update($user, $report))->toBe(false);
});

it('allows users to delete reports they own', function () {
    $user = User::factory()->create();
    $report = Report::factory()->create(['user_id' => $user->id]);

    $policy = new ReportPolicy();

    expect($policy->delete($user, $report))->toBe(true);
});

it('denies users to delete reports they do not own', function () {
    $user = User::factory()->create();
    $otherUser = User::factory()->create();
    $report = Report::factory()->create(['user_id' => $otherUser->id]);

    $policy = new ReportPolicy();

    expect($policy->delete($user, $report))->toBe(false);
});
