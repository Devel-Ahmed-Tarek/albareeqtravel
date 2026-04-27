<?php

namespace App\Filament\Resources\SiteTranslations;

use App\Filament\Resources\SiteTranslations\Pages\CreateSiteTranslation;
use App\Filament\Resources\SiteTranslations\Pages\EditSiteTranslation;
use App\Filament\Resources\SiteTranslations\Pages\ListSiteTranslations;
use App\Filament\Resources\SiteTranslations\Schemas\SiteTranslationForm;
use App\Filament\Resources\SiteTranslations\Tables\SiteTranslationsTable;
use App\Models\SiteTranslation;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class SiteTranslationResource extends Resource
{
    protected static ?string $model = SiteTranslation::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedLanguage;

    protected static string|UnitEnum|null $navigationGroup = 'Settings';

    protected static ?string $navigationLabel = 'Translations';

    protected static ?string $modelLabel = 'Translation';

    protected static ?string $pluralModelLabel = 'Translations';

    public static function form(Schema $schema): Schema
    {
        return SiteTranslationForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SiteTranslationsTable::configure($table);
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
            'index' => ListSiteTranslations::route('/'),
            'create' => CreateSiteTranslation::route('/create'),
            'edit' => EditSiteTranslation::route('/{record}/edit'),
        ];
    }
}
