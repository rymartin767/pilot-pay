<?php

namespace App\Filament\Resources\ReportResource\Pages;

use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\ReportResource;

class EditReport extends EditRecord
{
    protected static string $resource = ReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->label('Delete 2023 Report'),

            // Action::make('save')
            //     ->label('Save changes')
            //     ->action('save'),
        ];
    }

    protected function getSaveFormAction(): Action
    {
        return parent::getSaveFormAction()
            ->label('Save All Changes')
            ->color('info');
    }
}
