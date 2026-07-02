<?php

namespace App\Filament\Resources\BookingTransactions\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class BookingTransactionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('booking_trx_id')
                    ->label('Booking ID')
                    ->badge()
                    ->color('primary')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('name')
                    ->label('Customer')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('phone_number')
                    ->label('Phone')
                    ->searchable(),

                TextColumn::make('officeSpace.name')
                    ->label('Office Space')
                    ->badge()
                    ->sortable()
                    ->searchable(),

                TextColumn::make('total_amount')
                    ->label('Total')
                    ->money('IDR')
                    ->sortable(),

                TextColumn::make('duration')
                    ->label('Duration')
                    ->suffix(' Days')
                    ->sortable(),

                TextColumn::make('started_at')
                    ->label('Start')
                    ->date('d M Y')
                    ->sortable(),

                TextColumn::make('ended_at')
                    ->label('End')
                    ->date('d M Y')
                    ->sortable(),

                TextColumn::make('is_paid')
                    ->label('Payment')
                    ->badge()
                    ->formatStateUsing(fn (bool $state) => $state ? 'Paid' : 'Not Paid')
                    ->color(fn (bool $state) => $state ? 'success' : 'danger'),

                TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('office_space_id')
                    ->label('Office Space')
                    ->relationship('officeSpace', 'name')
                    ->searchable()
                    ->preload(),

                SelectFilter::make('is_paid')
                    ->label('Payment Status')
                    ->options([
                        1 => 'Paid',
                        0 => 'Not Paid',
                    ]),
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