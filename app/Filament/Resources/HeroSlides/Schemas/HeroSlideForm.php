<?php

namespace App\Filament\Resources\HeroSlides\Schemas;

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

class HeroSlideForm
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
                            ->directory('hero-slides')
                            ->visibility('public')
                            ->imagePreviewHeight('200')
                            ->maxSize(10_240)
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp', 'image/gif'])
                            ->downloadable()
                            ->openable()
                            ->nullable()
                            ->label('صورة الخلفية (من الجهاز)')
                            ->helperText('يُفضّل: إن وُجد ملف مرفوع يُستخدم بدل رابط. الحد 10 ميجابايت.')
                            ->columnSpanFull(),
                        TextInput::make('image')
                            ->url()
                            ->maxLength(2048)
                            ->label('رابط صورة الخلفية (احتياطي)')
                            ->helperText('يُستعمل فقط عند عدم رفع صورة (مثل Unsplash).'),
                    ])
                    ->columns(2),
                Tabs::make('hero_content')
                    ->label('نصوص وروابط (لغتان)')
                    ->tabs([
                        Tab::make('ar')
                            ->label('العربية')
                            ->schema([
                                TextInput::make('image_label_ar')
                                    ->maxLength(255)
                                    ->label('وصف الصورة (وصول)'),
                                TextInput::make('kicker_ar')
                                    ->maxLength(500)
                                    ->label('السطر فوق العنوان'),
                                Textarea::make('title_ar')
                                    ->required()
                                    ->rows(3)
                                    ->maxLength(1000)
                                    ->label('العنوان'),
                                Textarea::make('lead_ar')
                                    ->required()
                                    ->rows(4)
                                    ->maxLength(5000)
                                    ->label('المقدّمة'),
                                TextInput::make('primary_href_ar')
                                    ->url()
                                    ->maxLength(2048)
                                    ->label('رابط الجزء الأوّل (خارجي، مثل واتساب)'),
                                TextInput::make('primary_label_ar')
                                    ->maxLength(255)
                                    ->label('نص الزر الأوّل'),
                                TextInput::make('secondary_href_ar')
                                    ->url()
                                    ->maxLength(2048)
                                    ->label('رابط الجزء الثاني (خارجي)'),
                                TextInput::make('secondary_label_ar')
                                    ->maxLength(255)
                                    ->label('نص الزر الثاني'),
                            ]),
                        Tab::make('en')
                            ->label('English')
                            ->schema([
                                TextInput::make('image_label_en')
                                    ->maxLength(255)
                                    ->label('Image description (a11y)'),
                                TextInput::make('kicker_en')
                                    ->maxLength(500)
                                    ->label('Kicker / eyebrow line'),
                                Textarea::make('title_en')
                                    ->required()
                                    ->rows(3)
                                    ->maxLength(1000)
                                    ->label('Title'),
                                Textarea::make('lead_en')
                                    ->required()
                                    ->rows(4)
                                    ->maxLength(5000)
                                    ->label('Lead'),
                                TextInput::make('primary_href_en')
                                    ->url()
                                    ->maxLength(2048)
                                    ->label('Primary CTA (external URL)'),
                                TextInput::make('primary_label_en')
                                    ->maxLength(255)
                                    ->label('Primary button text'),
                                TextInput::make('secondary_href_en')
                                    ->url()
                                    ->maxLength(2048)
                                    ->label('Secondary CTA (external URL)'),
                                TextInput::make('secondary_label_en')
                                    ->maxLength(255)
                                    ->label('Secondary button text'),
                            ]),
                    ])
                    ->columnSpanFull(),
                Section::make('الروابط الداخلية (لغة الواجهة تلقائياً للمسار)')
                    ->schema([
                        Select::make('primary_route')
                            ->options(HeroSlide::internalRouteOptionsForForm())
                            ->searchable()
                            ->placeholder('— بدون —')
                            ->nullable()
                            ->label('رابط الزر الأوّل (داخلي)'),
                        Select::make('secondary_route')
                            ->options(HeroSlide::internalRouteOptionsForForm())
                            ->searchable()
                            ->placeholder('— بدون —')
                            ->nullable()
                            ->label('رابط الزر الثاني (داخلي)'),
                    ])
                    ->description('عند اختيار مسار داخلي يتجاهل الروابط الخارجية لنفس الزر. للواتساب: اختر داخلي «بدون» واملأ الرابط في تبويب كل لغة أو لغة واحدة مع النسخ الاحتياطي للعربي.'),
            ]);
    }
}
