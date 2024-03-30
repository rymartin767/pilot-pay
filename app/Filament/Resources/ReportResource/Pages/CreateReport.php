<?php

namespace App\Filament\Resources\ReportResource\Pages;

use Filament\Actions;
use App\Enums\ReportFleets;
use Filament\Support\RawJs;
use Illuminate\Support\Str;
use function Pest\Laravel\options;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
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
                    Select::make('longevity')
                        ->options([
                            'Salary' => 'Pay based on annual salary',
                            '1st Year' => '1st Year Pay Rate',
                            '2nd Year' => '2nd Year Pay Rate',
                            '3rd Year' => '3rd Year Pay Rate',
                            '4th Year' => '4th Year Pay Rate',
                            '5th Year' => '5th Year Pay Rate',
                            '6th Year' => '6th Year Pay Rate',
                            '7th Year' => '7th Year Pay Rate',
                            '8th Year' => '8th Year Pay Rate',
                            '9th Year' => '9th Year Pay Rate',
                            '10th Year' => '10th Year Pay Rate',
                            '11th Year' => '11th Year Pay Rate',
                            '12th Year' => '12th Year Pay Rate',
                            '+ 12 Years' => 'More than 12 Years'
                        ])
                        ->required(),
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
                        ])->columnSpan(1)
                ])->columns(3),
            Step::make('Add Compensation')
                ->description('Add your earnings')
                ->schema([
                    Hidden::make('user_id')->default(Auth::id()),
                    // Flight Pay
                    Textinput::make('flight_pay')
                        ->required()
                        ->mask(RawJs::make('$money($input)'))
                        ->stripCharacters(',')
                        ->numeric()
                        ->prefixIcon('heroicon-o-currency-dollar')
                        ->suffix('USD')
                        ->label('Gross W2 Wages (Flight Pay + Retro Pay)')
                        ->columnSpan(1),
                    // Profit Sharing
                    Textinput::make('profit_sharing')
                        ->required()
                        ->minValue(0)
                        ->validationMessages([
                            'required' => 'Field required. Enter $0 if you did not receive an employer profit sharing or bonus contribution.',
                        ])
                        ->mask(RawJs::make('$money($input)'))
                        ->stripCharacters(',')
                        ->numeric()
                        ->prefixIcon('heroicon-o-currency-dollar')
                        ->suffix('USD')
                        ->label('Profit Sharing and/or Bonus')
                        ->columnSpan(1)
                        ->columnStart(1),
                    // Retirement
                    Textinput::make('employer_retirement_contribution')
                        ->required()
                        ->minValue(0)
                        ->validationMessages([
                            'required' => 'Field required. Enter $0 if you did not receive an employer retirement contribution.',
                        ])
                        ->mask(RawJs::make('$money($input)'))
                        ->stripCharacters(',')
                        ->numeric()
                        ->prefixIcon('heroicon-o-currency-dollar')
                        ->suffix('USD')
                        ->label('Employer Retirement Contribution')
                        ->columnSpan(1)
                        ->columnStart(1),
                    // Health Savings
                    Textinput::make('employer_health_savings_contribution')
                        ->required()
                        ->minValue(0)
                        ->validationMessages([
                            'required' => 'Field required. Enter $0 if you did not receive an employer HSA contribution.',
                        ])
                        ->mask(RawJs::make('$money($input)'))
                        ->stripCharacters(',')
                        ->numeric()
                        ->nullable()
                        ->prefixIcon('heroicon-o-currency-dollar')
                        ->suffix('USD')
                        ->label('Employer Health Savings Contribution')
                        ->columnSpan(1)
                        ->columnStart(1),
                ])->columns(3),
            Step::make('Add Optional Information')
                ->description('Add your earnings')
                ->schema([
                    Select::make('is_commuter')
                        ->options([
                            0 => 'Non-Commuter',
                            1 => 'Commuter'
                        ])
                        ->nullable(),
                    Select::make('block_hours_flown')
                        ->nullable()
                        ->options([
                            '< 100' => 'Less than 100 hours flown',
                            '100 - 200' => 'Between 100 & 200 hours flown',
                            '200 - 300' => 'Between 200 & 300 hours flown',
                            '300 - 400' => 'Between 300 & 400 hours flown',
                        ]),
                    TextInput::make('days_worked')
                        ->numeric()
                        ->maxValue(365),
                    RichEditor::make('report_comment')
                        ->nullable()
                        ->columnSpanFull()
                ])->columns(3),
        ];
    }

    protected function handleRecordCreation(array $data): Model
    {
        // logos/atlas-air-300.webp
        $logo = Str::of($data['employer'] . '-300')->slug() . '.webp';

        $record = static::getModel()::make([
            "user_id" => $data['user_id'],
            "wage_year" => $data['wage_year'],
            "longevity" => $data['longevity'],
            "employer" => $data['employer'],
            "employer_logo_url" => 'logos/' . $logo,
            "fleet" => $data['fleet'],
            "seat" => $data['seat'],
        ]);

        $earnings = $record->earnings()->make([
            'flight_pay' => $data['flight_pay'],
            'profit_sharing' => $data['profit_sharing'],
            'employer_retirement_contribution' => $data['employer_retirement_contribution'],
            'employer_health_savings_contribution' => $data['employer_health_savings_contribution'],
            'is_commuter' => $data['is_commuter'],
            'block_hours_flown' => $data['block_hours_flown'],
            'days_worked' => $data['days_worked'],
            'report_comment' => $data['report_comment'],
        ]);

        if ($record && $earnings) {
            $record->save();
            $record->earnings()->create($earnings->toArray());
            return $record;
        }
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
