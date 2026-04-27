<?php

namespace App\Filament\Resources\VisaCategories;

use App\Filament\Resources\VisaCategories\Pages\CreateVisaCategory;
use App\Filament\Resources\VisaCategories\Pages\EditVisaCategory;
use App\Filament\Resources\VisaCategories\Pages\ListVisaCategories;
use App\Filament\Resources\VisaCategories\Schemas\VisaCategoryForm;
use App\Filament\Resources\VisaCategories\Tables\VisaCategoriesTable;
use App\Models\VisaCategory;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class VisaCategoryResource extends Resource
{
    protected static ?string $model = VisaCategory::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string|UnitEnum|null $navigationGroup = 'المحتوى';

    protected static ?string $navigationLabel = 'تصنيفات التأشيرات';

    protected static ?string $modelLabel = 'تصنيف تأشيرة';

    protected static ?string $pluralModelLabel = 'تصنيفات التأشيرات';

    public static function form(Schema $schema): Schema
    {
        return VisaCategoryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return VisaCategoriesTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListVisaCategories::route('/'),
            'create' => CreateVisaCategory::route('/create'),
            'edit' => EditVisaCategory::route('/{record}/edit'),
        ];
    }
}
