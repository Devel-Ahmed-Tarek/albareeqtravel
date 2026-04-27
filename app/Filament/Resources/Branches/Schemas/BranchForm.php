<?php

namespace App\Filament\Resources\Branches\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class BranchForm
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
                        TextInput::make('phone')
                            ->required()
                            ->maxLength(100)
                            ->label('رقم الجوال / التواصل')
                            ->placeholder('+966 55 608 7732')
                            ->helperText('يُعرض كما هو ويُبنى منه رابط الاتصال (أرقام و +).'),
                    ])
                    ->columns(2),
                Tabs::make('branch_texts')
                    ->label('النصوص (لغتان)')
                    ->tabs([
                        Tab::make('ar')
                            ->label('العربية')
                            ->schema([
                                TextInput::make('title_ar')
                                    ->required()
                                    ->maxLength(255)
                                    ->label('اسم الفرع / العنوان'),
                                Textarea::make('address_ar')
                                    ->rows(3)
                                    ->label('العنوان التفصيلي')
                                    ->columnSpanFull(),
                            ]),
                        Tab::make('en')
                            ->label('English')
                            ->schema([
                                TextInput::make('title_en')
                                    ->required()
                                    ->maxLength(255)
                                    ->label('Branch title'),
                                Textarea::make('address_en')
                                    ->rows(3)
                                    ->label('Address')
                                    ->columnSpanFull(),
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
