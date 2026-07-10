<?php

namespace App\Filament\Resources\Heroes\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class HeroForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),
                TextInput::make('subtitle')
                    ->required(),
                TextInput::make('cta_text')
                    ->required(),
                TextInput::make('cta_url')
                    ->url()
                    ->required(),
                FileUpload::make('background_image')
                    ->image()
                    ->required(),
                Toggle::make('is_active')
                    ->required(),
            ]);
    }
}
