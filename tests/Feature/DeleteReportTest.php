<?php

use App\Models\Report;
use Filament\Actions\DeleteAction;
use function Pest\Livewire\livewire;
use App\Filament\Resources\ReportResource\Pages\EditReport;
use App\Models\Earning;

it('can delete', function () {
    $report = Report::factory()->create();
 
    livewire(EditReport::class, [
        'record' => $report->getRouteKey(),
    ])
        ->callAction(DeleteAction::class);
 
    $this->assertModelMissing($report);
});

test('deleted reports will also delete earnings', function () {
    $earnings = Earning::factory()->create();

    livewire(EditReport::class, [
        'record' => $earnings->report->getRouteKey(),
    ])
        ->callAction(DeleteAction::class);
 
    $this->assertModelMissing($earnings);

});
