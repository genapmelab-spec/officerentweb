<?php

namespace App\Filament\Resources\Cities\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class CityForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->helperText('Gunakan nama data dengan tepat.')
                    ->required()
                    ->maxLength(255)
                    ->live()
                    ->afterStateUpdated(fn ($state, $set) => $set('slug', Str::slug($state))),

                TextInput::make('slug')
                    ->hidden()
                    ->dehydrated(),

                FileUpload::make('photo')
                    ->image()
                    ->required(),
            ]);
    }
}