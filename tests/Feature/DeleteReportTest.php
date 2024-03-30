<?php

use App\Models\Report;
use App\Models\Earning;
use Filament\Actions\DeleteAction;
use function Pest\Laravel\actingAs;
use function Pest\Livewire\livewire;
use App\Filament\Resources\ReportResource\Pages\EditReport;

it('can delete', function () {
    $report = Report::factory()->create();
    actingAs($report->user);

    livewire(EditReport::class, [
        'record' => $report->getRouteKey(),
    ])
        ->callAction(DeleteAction::class);
 
    $this->assertModelMissing($report);
});

test('deleted reports will also delete earnings', function () {
    $report = Report::factory()->create();
    actingAs($report->user);
    $earnings = $report->earnings()->create(Earning::factory()->raw());

    livewire(EditReport::class, [
        'record' => $report->getRouteKey(),
    ])
        ->callAction(DeleteAction::class);
 
    $this->assertModelMissing($earnings);

});
