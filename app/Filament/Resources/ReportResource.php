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
use Filament\Forms\Components\Actions\Action;
use App\Filament\Resources\ReportResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ReportResource\RelationManagers;

class ReportResource extends Resource
{
    protected static ?string $model = Report::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        // See Create Wizard
        $api = Http::withToken(config('auth.giant_api_token'))->get("https://api-v1.giantpilots.com/v1/airlines");
        $airlines = collect($api['data']);

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
                        Textinput::make('flight_pay')
                            // ->formatStateUsing(fn($state) => Number::currency($state))
                            ->required()
                            ->mask(RawJs::make('$money($input)'))
                            ->stripCharacters(',')
                            ->numeric()
                            ->prefixIcon('heroicon-o-currency-dollar')
                            ->label('W2 Wages (Gross)')
                            ->columnSpan(3),
                    ])
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
                ImageColumn::make('logo_url')
                    ->label('Logo'),
                TextColumn::make('wage_year')
                    ->description(fn ($record): string => $record->earnings == null ? '$0' : Number::currency($record->earnings->flight_pay))
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
