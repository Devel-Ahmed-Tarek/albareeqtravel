<?php

namespace App\Filament\Resources\MapDestinationSlides;

use App\Filament\Resources\MapDestinationSlides\Pages\CreateMapDestinationSlide;
use App\Filament\Resources\MapDestinationSlides\Pages\EditMapDestinationSlide;
use App\Filament\Resources\MapDestinationSlides\Pages\ListMapDestinationSlides;
use App\Filament\Resources\MapDestinationSlides\Schemas\MapDestinationSlideForm;
use App\Filament\Resources\MapDestinationSlides\Tables\MapDestinationSlidesTable;
use App\Models\MapDestinationSlide;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class MapDestinationSlideResource extends Resource
{
    protected static ?string $model = MapDestinationSlide::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedGlobeAlt;

    protected static string|UnitEnum|null $navigationGroup = 'المحتوى';

    protected static ?string $navigationLabel = 'سلايدر وجهات الخريطة';

    protected static ?string $modelLabel = 'بطاقة';

    protected static ?string $pluralModelLabel = 'وجهات الخريطة (الرئيسية)';

    public static function form(Schema $schema): Schema
    {
        return MapDestinationSlideForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MapDestinationSlidesTable::configure($table);
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
            'index' => ListMapDestinationSlides::route('/'),
            'create' => CreateMapDestinationSlide::route('/create'),
            'edit' => EditMapDestinationSlide::route('/{record}/edit'),
        ];
    }
}
