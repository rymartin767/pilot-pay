<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Earning;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Number;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Auth;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\EarningResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\EarningResource\RelationManagers;

class EarningResource extends Resource
{
    protected static ?string $model = Earning::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';

    public static function canAccess(): bool
    {
        return Auth::user()->earnings->isNotEmpty();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('report.wage_year')
                    ->description(fn ($record) =>  Number::currency($record->total_compensation)),
                TextColumn::make('report.employer')
                    ->description(fn ($record) =>  $record->report->fleet->name . ' ' . $record->report->seat)
                    ->label('Employer'),
                TextColumn::make('flight_pay')
                    ->formatStateUsing(fn ($state) => Number::currency($state))

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->url(fn (Earning $record): string => "/dashboard/reports/{$record->report_id}/edit"),
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
            'index' => Pages\ListEarnings::route('/'),
            'create' => Pages\CreateEarning::route('/create'),
            'edit' => Pages\EditEarning::route('/{record}/edit'),
        ];
    }
}
