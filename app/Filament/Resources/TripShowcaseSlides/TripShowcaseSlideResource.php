<?php

namespace App\Filament\Resources\TripShowcaseSlides;

use App\Filament\Resources\TripShowcaseSlides\Pages\CreateTripShowcaseSlide;
use App\Filament\Resources\TripShowcaseSlides\Pages\EditTripShowcaseSlide;
use App\Filament\Resources\TripShowcaseSlides\Pages\ListTripShowcaseSlides;
use App\Filament\Resources\TripShowcaseSlides\Schemas\TripShowcaseSlideForm;
use App\Filament\Resources\TripShowcaseSlides\Tables\TripShowcaseSlidesTable;
use App\Models\TripShowcaseSlide;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class TripShowcaseSlideResource extends Resource
{
    protected static ?string $model = TripShowcaseSlide::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string|UnitEnum|null $navigationGroup = 'المحتوى';

    protected static ?string $navigationLabel = 'نماذج الرحلات (الرئيسية)';

    protected static ?string $modelLabel = 'بطاقة';

    protected static ?string $pluralModelLabel = 'بطاقات رحلات الصفحة الرئيسية';

    public static function form(Schema $schema): Schema
    {
        return TripShowcaseSlideForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TripShowcaseSlidesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTripShowcaseSlides::route('/'),
            'create' => CreateTripShowcaseSlide::route('/create'),
            'edit' => EditTripShowcaseSlide::route('/{record}/edit'),
        ];
    }
}
