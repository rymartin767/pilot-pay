<?php

namespace App\Filament\Resources\ReportResource\Pages;

use Filament\Actions;
use Illuminate\Support\Facades\Auth;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\ReportResource;

class ListReports extends ListRecords
{
    protected static string $resource = ReportResource::class;

    protected function getHeaderActions(): array
    {
        if (Auth::user()->reports->isEmpty()) {
            return [
                Actions\CreateAction::make()
                    ->label('Create Report'),
            ];
        } else {
            return [];
        }
    }
}
