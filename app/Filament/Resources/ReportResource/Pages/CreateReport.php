<?php

namespace App\Filament\Resources\ReportResource\Pages;

use Filament\Actions;
use App\Enums\ReportFleets;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use App\Filament\Resources\ReportResource;
use Filament\Forms\Components\Wizard\Step;
use Filament\Resources\Pages\CreateRecord;

class CreateReport extends CreateRecord
{
    use CreateRecord\Concerns\HasWizard;

    protected static string $resource = ReportResource::class;

    protected static bool $canCreateAnother = false;

    protected function getSteps(): array
    {
        $api = Http::withToken(config('auth.giant_api_token'))->get("https://api-v1.giantpilots.com/v1/airlines");
        $airlines = collect($api['data']);
        
        return [
            Step::make('Create Report')
                ->description('Start with basic information about your 2023 employment')
                ->schema([
                    Hidden::make('user_id')->default(Auth::id()),
                    Select::make('wage_year')
                        ->default('2023')
                        ->required()
                        ->options([
                            '2023' => '2023'
                        ]),
                    Select::make('employer')
                        ->required()
                        ->label('Employer')
                        ->options($airlines->pluck('name', 'name')->toArray()),
                    Select::make('fleet')
                        ->required()
                        ->options(ReportFleets::generateSelectOptions()),
                    Select::make('seat')
                        ->required()
                        ->options([
                            'CA' => 'CA',
                            'FO' => 'FO'
                        ])->columnSpan(2)
                ])->columns(3),
            Step::make('Add Compensation')
                ->description('Start with basic information about your 2023 employment')
                ->schema([
                    Hidden::make('user_id')->default(Auth::id()),
                    Select::make('wage_year')
                        ->default('2023')
                        ->required()
                        ->options([
                            '2023' => '2023'
                        ]),
                    Select::make('employer')
                        ->required()
                        ->label('Employer')
                        ->options($airlines->pluck('name', 'name')->toArray()),
                    Select::make('fleet')
                        ->required()
                        ->options(ReportFleets::generateSelectOptions()),
                    Select::make('seat')
                        ->required()
                        ->options([
                            'CA' => 'CA',
                            'FO' => 'FO'
                        ])->columnSpan(2)
                ])->columns(3),
        ];
    }

    // protected function mutateFormDataBeforeCreate(array $data): array
    // {
    //     $data['airline_slug'] = Str::of($data['airline_slug'])->slug();
    
    //     return $data;
    // }
}
