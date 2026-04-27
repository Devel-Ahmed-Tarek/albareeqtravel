<?php

namespace App\Filament\Resources\Visas;

use App\Filament\Resources\Visas\Pages\CreateVisa;
use App\Filament\Resources\Visas\Pages\EditVisa;
use App\Filament\Resources\Visas\Pages\ListVisas;
use App\Filament\Resources\Visas\Schemas\VisaForm;
use App\Filament\Resources\Visas\Tables\VisasTable;
use App\Models\Visa;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class VisaResource extends Resource
{
    protected static ?string $model = Visa::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedTag;

    protected static string|UnitEnum|null $navigationGroup = 'المحتوى';

    protected static ?string $navigationLabel = 'التأشيرات';

    protected static ?string $modelLabel = 'تأشيرة';

    protected static ?string $pluralModelLabel = 'التأشيرات';

    public static function form(Schema $schema): Schema
    {
        return VisaForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return VisasTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListVisas::route('/'),
            'create' => CreateVisa::route('/create'),
            'edit' => EditVisa::route('/{record}/edit'),
        ];
    }
}
