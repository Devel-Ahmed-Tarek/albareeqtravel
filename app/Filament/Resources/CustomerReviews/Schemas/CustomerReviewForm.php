<?php

namespace App\Filament\Resources\CustomerReviews\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class CustomerReviewForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('عام')
                    ->schema([
                        TextInput::make('sort_order')
                            ->numeric()
                            ->default(0)
                            ->label('الترتيب'),
                        Toggle::make('is_active')
                            ->default(true)
                            ->label('مفعّل'),
                        Select::make('rating')
                            ->options([
                                1 => '1',
                                2 => '2',
                                3 => '3',
                                4 => '4',
                                5 => '5',
                            ])
                            ->default(5)
                            ->required()
                            ->label('التقييم (نجوم)'),
                    ])
                    ->columns(2),
                Tabs::make('texts')
                    ->label('النصوص')
                    ->tabs([
                        Tab::make('ar')
                            ->label('العربية')
                            ->schema([
                                Textarea::make('quote_ar')
                                    ->required()
                                    ->rows(4)
                                    ->label('نص الرأي')
                                    ->columnSpanFull(),
                                TextInput::make('name_ar')
                                    ->required()
                                    ->maxLength(120)
                                    ->label('الاسم (يُستخرج منه حرف المختصر)'),
                                TextInput::make('from_city_ar')
                                    ->required()
                                    ->maxLength(120)
                                    ->label('المدينة / المنطقة'),
                            ]),
                        Tab::make('en')
                            ->label('English')
                            ->schema([
                                Textarea::make('quote_en')
                                    ->required()
                                    ->rows(4)
                                    ->label('Review text')
                                    ->columnSpanFull(),
                                TextInput::make('name_en')
                                    ->required()
                                    ->maxLength(120)
                                    ->label('Name (first letter for avatar)'),
                                TextInput::make('from_city_en')
                                    ->required()
                                    ->maxLength(120)
                                    ->label('City / area'),
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
