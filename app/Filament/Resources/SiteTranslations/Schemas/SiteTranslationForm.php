<?php

namespace App\Filament\Resources\SiteTranslations\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class SiteTranslationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('key')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true)
                    ->placeholder('site.home.about_title')
                    ->label('Key'),
                Select::make('group')
                    ->options([
                        'home' => 'home',
                        'about' => 'about',
                        'programs' => 'programs',
                        'hotels' => 'hotels',
                        'destinations' => 'destinations',
                        'contact' => 'contact',
                        'other' => 'other',
                    ])
                    ->searchable()
                    ->label('Group'),
                Toggle::make('is_active')
                    ->default(true)
                    ->label('Active'),
                Textarea::make('value_ar')
                    ->rows(4)
                    ->columnSpanFull()
                    ->label('Arabic value'),
                Textarea::make('value_en')
                    ->rows(4)
                    ->columnSpanFull()
                    ->label('English value'),
            ]);
    }
}
