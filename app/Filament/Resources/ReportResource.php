<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Report;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Enums\ReportFleets;
use Filament\Support\RawJs;
use Illuminate\Support\Number;
use Illuminate\Validation\Rule;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Actions\Action;
use App\Filament\Resources\ReportResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ReportResource\RelationManagers;

class ReportResource extends Resource
{
    protected static ?string $model = Report::class;

    protected static ?string $modelLabel = 'Your Reports';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        // See Create Wizard
        $api = Http::withToken(config('auth.giant_api_token'))->get("https://api-v1.giantpilots.com/v1/airlines");
        $airlines = collect($api['data'])->sortBy('name');
        $airlines_array = $airlines->pluck('name', 'name')->toArray();

        return $form
            ->schema([
                Section::make('2023 Report')
                    ->description('Edit Your Employee Report')
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
                            ->options($airlines_array),
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
                                'CA2FO' => 'CA Transitions to FO',
                            ]),
                    ])
                    ->footerActions([
                        fn (string $operation): Action => Action::make('save')
                            ->action(function (Section $component, EditRecord $livewire) {
                                $livewire->saveFormComponentOnly($component);

                                Notification::make()
                                    ->title('Report Saved!')
                                    ->body('The rate limiting settings have been saved successfully.')
                                    ->success()
                                    ->send();
                            })
                            ->visible($operation === 'edit'),
                    ]),
                Section::make('2023 Earnings')
                    ->description('Edit Your Earnings')
                    ->relationship('earnings')
                    ->schema([
                        // Total Compensation
                        Textinput::make('total_compensation')
                            ->required()
                            ->mask(RawJs::make('$money($input)'))
                            ->stripCharacters(',')
                            ->numeric()
                            ->prefixIcon('heroicon-o-currency-dollar')
                            ->suffix('USD')
                            ->label('Gross W2 Wages (Flight Pay + Retro Pay)')
                            ->columnSpan(1),
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
                            ->columnSpan(1),
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
                            ->columnSpan(1),
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
                    ])->columns(3)
                    ->footerActions([
                        fn (string $operation): Action => Action::make('save')
                            ->action(function (Section $component, EditRecord $livewire) {
                                $livewire->saveFormComponentOnly($component);

                                Notification::make()
                                    ->title('Earning Updated!')
                                    ->body('Your 2023 report earnings have been saved.')
                                    ->success()
                                    ->send();
                            })
                            ->visible($operation === 'edit')
                            ->color('success')
                            ->icon('heroicon-m-currency-dollar')
                            ->label('Save Earnings'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('employer_logo_url')
                    ->disk('s3')
                    ->label(''),
                TextColumn::make('wage_year')
                    ->description(fn ($record): string => $record->earnings == null ? '$0' : Number::currency($record->earnings->total_compensation))
                    ->label('Year/Wages'),
                TextColumn::make('employer')
                    ->label('Employer'),
                TextColumn::make('fleet')
                    ->formatStateUsing(fn ($state) => $state->name),
                TextColumn::make('seat')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListReports::route('/'),
            'create' => Pages\CreateReport::route('/create'),
            'edit' => Pages\EditReport::route('/{record}/edit'),
        ];
    }
}
