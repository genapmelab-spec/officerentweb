<?php

namespace App\Filament\Resources\BookingTransactions\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class BookingTransactionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                TextInput::make('booking_trx_id')
                    ->label('Booking Transaction ID')
                    ->required()
                    ->maxLength(255),

                TextInput::make('phone_number')
                    ->tel()
                    ->required()
                    ->maxLength(20),

                TextInput::make('total_amount')
                    ->numeric()
                    ->prefix('IDR')
                    ->required(),

                TextInput::make('duration')
                    ->numeric()
                    ->suffix('Days')
                    ->required(),

                DatePicker::make('started_at')
                    ->required(),

                DatePicker::make('ended_at')
                    ->required(),

                Select::make('is_paid')
                    ->label('Payment Status')
                    ->options([
                        true => 'Paid',
                        false => 'Not Paid',
                    ])
                    ->required(),

                Select::make('office_space_id')
                    ->label('Office Space')
                    ->relationship('officeSpace', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
            ]);
    }
}