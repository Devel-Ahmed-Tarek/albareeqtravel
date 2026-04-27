<?php

namespace App\Filament\Resources\HotelShowcaseSlides;

use App\Filament\Resources\HotelShowcaseSlides\Pages\CreateHotelShowcaseSlide;
use App\Filament\Resources\HotelShowcaseSlides\Pages\EditHotelShowcaseSlide;
use App\Filament\Resources\HotelShowcaseSlides\Pages\ListHotelShowcaseSlides;
use App\Filament\Resources\HotelShowcaseSlides\Schemas\HotelShowcaseSlideForm;
use App\Filament\Resources\HotelShowcaseSlides\Tables\HotelShowcaseSlidesTable;
use App\Models\HotelShowcaseSlide;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class HotelShowcaseSlideResource extends Resource
{
    protected static ?string $model = HotelShowcaseSlide::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBuildingOffice2;

    protected static string|UnitEnum|null $navigationGroup = 'المحتوى';

    protected static ?string $navigationLabel = 'بطاقات الفنادق (الموقع)';

    protected static ?string $modelLabel = 'بطاقة';

    protected static ?string $pluralModelLabel = 'فنادق صفحة الفنادق';

    public static function form(Schema $schema): Schema
    {
        return HotelShowcaseSlideForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return HotelShowcaseSlidesTable::configure($table);
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
            'index' => ListHotelShowcaseSlides::route('/'),
            'create' => CreateHotelShowcaseSlide::route('/create'),
            'edit' => EditHotelShowcaseSlide::route('/{record}/edit'),
        ];
    }
}
