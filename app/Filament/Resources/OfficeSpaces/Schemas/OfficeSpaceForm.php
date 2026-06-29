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
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                Select::make('city_id')
                    ->label('City')
                    ->relationship('city', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),

                FileUpload::make('thumbnail')
                    ->image()
                    ->directory('office-spaces')
                    ->required(),

                TextInput::make('price')
                    ->label('Price')
                    ->numeric()
                    ->prefix('IDR')
                    ->required(),

                TextInput::make('duration')
                    ->label('Duration')
                    ->numeric()
                    ->suffix('Month')
                    ->required(),

                TextInput::make('address')
                    ->required()
                    ->maxLength(255),

                Radio::make('is_open')
                    ->label('Office Status')
                    ->boolean()
                    ->options([
                        true => 'Open',
                        false => 'Closed',
                    ])
                    ->inline()
                    ->required(),

                Radio::make('is_full_booked')
                    ->label('Availability')
                    ->boolean()
                    ->options([
                        true => 'Not Available',
                        false => 'Available',
                    ])
                    ->inline()
                    ->required(),

                Textarea::make('about')
                    ->rows(6)
                    ->columnSpanFull()
                    ->required(),

                Repeater::make('photos')
                    ->relationship('photos')
                    ->columnSpanFull()
                    ->schema([
                        FileUpload::make('photo')
                            ->image()
                            ->directory('office-space-photos')
                            ->required(),
                    ]),

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
