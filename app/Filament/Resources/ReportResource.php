<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Report;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Enums\ReportFleets;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\ReportResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ReportResource\RelationManagers;

class ReportResource extends Resource
{
    protected static ?string $model = Report::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        $api = Http::withToken(config('auth.giant_api_token'))->get("https://api-v1.giantpilots.com/v1/airlines");
        $airlines = collect($api['data']);

        return $form
            ->schema([
                Section::make('2023 Report')
                ->description('STEP ONE: Add Your Employer Report')
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
                        ]),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            ImageColumn::make('logo_url')
                ->label('Logo'),
            TextColumn::make('wage_year')
                // ->description(fn ($record): string => $record->compensation == null ? '$0' : Number::currency($record->compensation->wages))
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
