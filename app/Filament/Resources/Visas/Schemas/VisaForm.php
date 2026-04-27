<?php

namespace App\Filament\Resources\Visas\Schemas;

use App\Models\VisaCategory;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class VisaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('عام')
                ->schema([
                    Select::make('visa_category_id')
                        ->label('التصنيف')
                        ->options(fn () => VisaCategory::query()->orderBy('sort_order')->pluck('name_ar', 'id')->all())
                        ->searchable()
                        ->preload()
                        ->nullable(),
                    FileUpload::make('image_path')
                        ->image()
                        ->disk('public')
                        ->directory('visas')
                        ->visibility('public')
                        ->imagePreviewHeight('160')
                        ->maxSize(10_240)
                        ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp', 'image/gif'])
                        ->downloadable()
                        ->openable()
                        ->nullable()
                        ->label('الصورة (رفع من الجهاز)')
                        ->helperText('لو رفعت صورة هنا، سيتم استخدامها بدل رابط الصورة.')
                        ->columnSpan(2),
                    TextInput::make('image')
                        ->url()
                        ->maxLength(2048)
                        ->label('رابط الصورة (اختياري)')
                        ->helperText('يُستخدم فقط إذا لم يتم رفع صورة من الجهاز.')
                        ->columnSpan(2),
                    TextInput::make('currency')
                        ->default('USD')
                        ->maxLength(8)
                        ->label('العملة'),
                    TextInput::make('price_old')
                        ->numeric()
                        ->prefix('$')
                        ->label('السعر قبل الخصم'),
                    TextInput::make('price_from')
                        ->required()
                        ->numeric()
                        ->prefix('$')
                        ->label('السعر الحالي'),
                    TextInput::make('discount_percent')
                        ->numeric()
                        ->minValue(0)
                        ->maxValue(99)
                        ->suffix('%')
                        ->label('نسبة الخصم'),
                    TextInput::make('sort_order')
                        ->numeric()
                        ->default(0)
                        ->label('الترتيب'),
                    Toggle::make('is_active')
                        ->default(true)
                        ->label('فعّال'),
                ])
                ->columns(4),
            Tabs::make('content')
                ->label('نصوص')
                ->tabs([
                    Tab::make('ar')
                        ->label('العربية')
                        ->schema([
                            TextInput::make('country_ar')->required()->maxLength(255)->label('الدولة'),
                            TextInput::make('code_ar')->maxLength(255)->label('رمز/نوع التأشيرة'),
                            TextInput::make('processing_time_ar')->maxLength(255)->label('مدة الإصدار'),
                            TextInput::make('validity_ar')->maxLength(255)->label('مدة الصلاحية'),
                            TextInput::make('wa_text_ar')
                                ->maxLength(1000)
                                ->label('نص مسبق واتساب')
                                ->columnSpanFull(),
                        ]),
                    Tab::make('en')
                        ->label('English')
                        ->schema([
                            TextInput::make('country_en')->required()->maxLength(255)->label('Country'),
                            TextInput::make('code_en')->maxLength(255)->label('Visa code/type'),
                            TextInput::make('processing_time_en')->maxLength(255)->label('Processing time'),
                            TextInput::make('validity_en')->maxLength(255)->label('Validity'),
                            TextInput::make('wa_text_en')
                                ->maxLength(1000)
                                ->label('WhatsApp preset')
                                ->columnSpanFull(),
                        ]),
                ]),
        ]);
    }
}
