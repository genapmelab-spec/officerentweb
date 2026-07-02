<?php

namespace App\Filament\Resources\OfficeSpaces\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class OfficeSpaceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                FileUpload::make('thumbnail')
                    ->image()
                    ->directory('office-spaces')
                    ->required(),

                Select::make('city_id')
                    ->label('City')
                    ->relationship('city', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),

                Repeater::make('photos')
                    ->relationship('photos')
                    ->schema([
                        FileUpload::make('photo')
                            ->image()
                            ->directory('office-space-photos')
                            ->required(),
                    ]),

                TextInput::make('price')
                    ->label('Price')
                    ->numeric()
                    ->prefix('IDR')
                    ->required(),

                TextInput::make('duration')
                    ->label('Duration')
                    ->numeric()
                    ->suffix('Day')
                    ->required(),

                TextInput::make('address')
                    ->columnSpanFull()
                    ->required(),

                Radio::make('is_open')
                    ->label('Office Status')
                    ->options([
                        1 => 'Open',
                        0 => 'Closed',
                    ])
                    ->inline()
                    ->required(),

                Radio::make('is_full_booked')
                    ->label('Availability')
                    ->options([
                        0 => 'Available',
                        1 => 'Not Available',
                    ])
                    ->inline()
                    ->required(),

                Textarea::make('about')
                    ->rows(6)
                    ->columnSpanFull()
                    ->required(),

                Repeater::make('benefits')
                    ->relationship('benefits')
                    ->columnSpanFull()
                    ->schema([
                        TextInput::make('name')
                            ->required(),
                    ]),
            ]);
    }
}