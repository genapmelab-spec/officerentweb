<?php

namespace App\Filament\Resources\OfficeSpaces\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class OfficeSpacesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('thumbnail')
                    ->label('Thumbnail')
                    ->square(),

                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('city.name')
                    ->label('City')
                    ->badge()
                    ->sortable()
                    ->searchable(),

                TextColumn::make('price')
                    ->money('IDR')
                    ->sortable(),

                TextColumn::make('duration')
                    ->suffix(' Month')
                    ->sortable(),

                TextColumn::make('is_open')
                    ->label('Office Status')
                    ->badge()
                    ->formatStateUsing(fn (bool $state) => $state ? 'Open' : 'Closed')
                    ->color(fn (bool $state) => $state ? 'success' : 'danger'),

                TextColumn::make('is_full_booked')
                    ->label('Availability')
                    ->badge()
                    ->formatStateUsing(fn (bool $state) => $state ? 'Not Available' : 'Available')
                    ->color(fn (bool $state) => $state ? 'danger' : 'success'),

                TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime('d M Y')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('city')
                    ->label('City')
                    ->relationship('city', 'name')
                    ->searchable()
                    ->preload(),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}