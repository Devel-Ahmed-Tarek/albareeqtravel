<?php

namespace App\Filament\Resources\Offers\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class OfferForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('عام')
                    ->schema([
                        TextInput::make('image')
                            ->url()
                            ->maxLength(2048)
                            ->label('رابط الصورة'),
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
                                TextInput::make('title_ar')->required()->maxLength(255),
                                Textarea::make('desc_ar')
                                    ->rows(3)
                                    ->required()
                                    ->columnSpanFull(),
                                TextInput::make('badge_ar')
                                    ->maxLength(120)
                                    ->label('شارة (اختياري)'),
                                TextInput::make('valid_note_ar')
                                    ->maxLength(500)
                                    ->label('الصلاحية / الملاحظة'),
                                TextInput::make('wa_text_ar')
                                    ->maxLength(1000)
                                    ->label('نص مسبق واتساب')
                                    ->columnSpanFull(),
                            ]),
                        Tab::make('en')
                            ->label('English')
                            ->schema([
                                TextInput::make('title_en')->required()->maxLength(255),
                                Textarea::make('desc_en')
                                    ->rows(3)
                                    ->required()
                                    ->columnSpanFull(),
                                TextInput::make('badge_en')
                                    ->maxLength(120)
                                    ->label('Badge'),
                                TextInput::make('valid_note_en')
                                    ->maxLength(500)
                                    ->label('Validity note'),
                                TextInput::make('wa_text_en')
                                    ->maxLength(1000)
                                    ->label('WhatsApp preset')
                                    ->columnSpanFull(),
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
