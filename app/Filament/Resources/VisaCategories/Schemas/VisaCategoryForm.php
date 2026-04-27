<?php

namespace App\Filament\Resources\VisaCategories\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class VisaCategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('عام')
                ->schema([
                    TextInput::make('slug')
                        ->required()
                        ->maxLength(120)
                        ->rules(['alpha_dash'])
                        ->unique(ignoreRecord: true)
                        ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug((string) $state)))
                        ->label('Slug'),
                    TextInput::make('sort_order')
                        ->numeric()
                        ->default(0)
                        ->label('الترتيب'),
                    Toggle::make('is_active')
                        ->default(true)
                        ->label('فعّال'),
                ])
                ->columns(3),
            Tabs::make('content')
                ->label('نصوص')
                ->tabs([
                    Tab::make('ar')
                        ->label('العربية')
                        ->schema([
                            TextInput::make('name_ar')->required()->maxLength(255)->label('اسم التصنيف'),
                        ]),
                    Tab::make('en')
                        ->label('English')
                        ->schema([
                            TextInput::make('name_en')->required()->maxLength(255)->label('Category name'),
                        ]),
                ]),
        ]);
    }
}
