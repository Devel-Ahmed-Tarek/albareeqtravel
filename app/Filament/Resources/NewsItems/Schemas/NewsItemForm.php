<?php

namespace App\Filament\Resources\NewsItems\Schemas;

use App\Models\NewsItem;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class NewsItemForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('عام')
                    ->schema([
                        TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(NewsItem::class, 'slug', ignoreRecord: true)
                            ->label('الرابط (slug)'),
                        TextInput::make('image')
                            ->url()
                            ->maxLength(2048)
                            ->label('رابط صورة'),
                        DateTimePicker::make('published_at')
                            ->label('تاريخ النشر')
                            ->seconds(false),
                        Toggle::make('is_published')
                            ->default(true)
                            ->label('منشور'),
                    ])
                    ->columns(2),
                Tabs::make('content')
                    ->label('المحتوى')
                    ->tabs([
                        Tab::make('ar')
                            ->label('العربية')
                            ->schema([
                                TextInput::make('title_ar')->required()->maxLength(255),
                                Textarea::make('excerpt_ar')
                                    ->rows(3)
                                    ->required()
                                    ->columnSpanFull(),
                                RichEditor::make('body_ar')
                                    ->required()
                                    ->columnSpanFull(),
                            ]),
                        Tab::make('en')
                            ->label('English')
                            ->schema([
                                TextInput::make('title_en')->required()->maxLength(255),
                                Textarea::make('excerpt_en')
                                    ->rows(3)
                                    ->required()
                                    ->columnSpanFull(),
                                RichEditor::make('body_en')
                                    ->required()
                                    ->columnSpanFull(),
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
