<?php

namespace App\Filament\Resources\TripShowcaseSlides\Schemas;

use App\Models\HeroSlide;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class TripShowcaseSlideForm
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
                        FileUpload::make('image_path')
                            ->image()
                            ->disk('public')
                            ->directory('trip-showcase-slides')
                            ->visibility('public')
                            ->imagePreviewHeight('160')
                            ->maxSize(10_240)
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp', 'image/gif'])
                            ->downloadable()
                            ->openable()
                            ->nullable()
                            ->label('صورة البطاقة (من الجهاز)')
                            ->helperText('يُفضّل. إن لم تُرفع تُستخدم رابط الصورة أدناه.')
                            ->columnSpanFull(),
                        TextInput::make('image')
                            ->url()
                            ->maxLength(2048)
                            ->label('رابط الصورة (احتياطي)')
                            ->helperText('يُستعمل عند عدم رفع ملف (مثلاً Unsplash).'),
                    ])
                    ->columns(2),
                Section::make('رابط البطاقة')
                    ->schema([
                        Select::make('link_route')
                            ->options(HeroSlide::internalRouteOptionsForForm())
                            ->searchable()
                            ->placeholder('— افتراضي: صفحة البرامج —')
                            ->nullable()
                            ->label('رابط داخلي'),
                        TextInput::make('link_href_ar')
                            ->url()
                            ->maxLength(2048)
                            ->label('رابط خارجي (عربي، مثل واتساب)'),
                        TextInput::make('link_href_en')
                            ->url()
                            ->maxLength(2048)
                            ->label('رابط خارجي (English)'),
                    ])
                    ->description('إن وُجد «رابط داخلي» يُستخدم. وإلا يُستعمل الرابط الخارجي لكل لغة. وإن لم تُضف: يُفتح صفحة البرامج.'),
                Tabs::make('texts')
                    ->label('النصوص')
                    ->tabs([
                        Tab::make('ar')
                            ->label('العربية')
                            ->schema([
                                TextInput::make('title_ar')
                                    ->required()
                                    ->maxLength(255)
                                    ->label('العنوان'),
                                Textarea::make('desc_ar')
                                    ->required()
                                    ->rows(3)
                                    ->label('الوصف')
                                    ->columnSpanFull(),
                                TextInput::make('badge_ar')
                                    ->maxLength(120)
                                    ->label('شارة (اختياري)'),
                            ]),
                        Tab::make('en')
                            ->label('English')
                            ->schema([
                                TextInput::make('title_en')
                                    ->required()
                                    ->maxLength(255)
                                    ->label('Title'),
                                Textarea::make('desc_en')
                                    ->required()
                                    ->rows(3)
                                    ->label('Description')
                                    ->columnSpanFull(),
                                TextInput::make('badge_en')
                                    ->maxLength(120)
                                    ->label('Badge (optional)'),
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
