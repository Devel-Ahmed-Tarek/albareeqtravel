<?php

namespace App\Filament\Resources\NewsItems;

use App\Filament\Resources\NewsItems\Pages\CreateNewsItem;
use App\Filament\Resources\NewsItems\Pages\EditNewsItem;
use App\Filament\Resources\NewsItems\Pages\ListNewsItems;
use App\Filament\Resources\NewsItems\Schemas\NewsItemForm;
use App\Filament\Resources\NewsItems\Tables\NewsItemsTable;
use App\Models\NewsItem;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class NewsItemResource extends Resource
{
    protected static ?string $model = NewsItem::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedNewspaper;

    protected static string|UnitEnum|null $navigationGroup = 'المحتوى';

    protected static ?string $navigationLabel = 'الأخبار';

    protected static ?string $modelLabel = 'خبر';

    protected static ?string $pluralModelLabel = 'أخبار';

    public static function form(Schema $schema): Schema
    {
        return NewsItemForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return NewsItemsTable::configure($table);
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
            'index' => ListNewsItems::route('/'),
            'create' => CreateNewsItem::route('/create'),
            'edit' => EditNewsItem::route('/{record}/edit'),
        ];
    }
}
