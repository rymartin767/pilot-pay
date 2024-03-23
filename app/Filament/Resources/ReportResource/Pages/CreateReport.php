<?php

namespace App\Filament\Resources\ReportResource\Pages;

use Filament\Actions;
use App\Enums\ReportFleets;
use Filament\Support\RawJs;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
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
                            'FO' => 'FO',
                            'FO2CA' => 'FO Upgrade to CA',
                            'CA2FO' => 'CA Transition to FO',
                        ])->columnSpan(2)
                ])->columns(3),
            Step::make('Add Compensation')
                ->description('Add your earnings')
                ->schema([
                    Hidden::make('user_id')->default(Auth::id()),
                    Textinput::make('flight_pay')
                        ->required()
                        ->mask(RawJs::make('$money($input)'))
                        ->stripCharacters(',')
                        ->numeric()
                        ->prefixIcon('heroicon-o-currency-dollar')
                        ->label('W2 Wages (Gross)')
                        ->columnSpan(3),
                ])->columns(3),
        ];
    }

    protected function handleRecordCreation(array $data): Model
    {
        $record = static::getModel()::create([
            "user_id" => $data['user_id'],
            "wage_year" => $data['wage_year'],
            "employer" => $data['employer'],
            "fleet" => $data['fleet'],
            "seat" => $data['seat'],
        ]);

        $record->earnings()->create([
            'flight_pay' => $data['flight_pay']
        ]);

        return $record;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Your 2023 Report was created!';
    }
}
