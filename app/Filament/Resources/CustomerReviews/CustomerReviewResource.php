<?php

namespace App\Filament\Resources\CustomerReviews;

use App\Filament\Resources\CustomerReviews\Pages\CreateCustomerReview;
use App\Filament\Resources\CustomerReviews\Pages\EditCustomerReview;
use App\Filament\Resources\CustomerReviews\Pages\ListCustomerReviews;
use App\Filament\Resources\CustomerReviews\Schemas\CustomerReviewForm;
use App\Filament\Resources\CustomerReviews\Tables\CustomerReviewsTable;
use App\Models\CustomerReview;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class CustomerReviewResource extends Resource
{
    protected static ?string $model = CustomerReview::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChatBubbleLeftRight;

    protected static string|UnitEnum|null $navigationGroup = 'المحتوى';

    protected static ?string $navigationLabel = 'آراء العملاء (الرئيسية)';

    protected static ?string $modelLabel = 'رأي';

    protected static ?string $pluralModelLabel = 'آراء تظهر في الصفحة الرئيسية';

    public static function form(Schema $schema): Schema
    {
        return CustomerReviewForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CustomerReviewsTable::configure($table);
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
            'index' => ListCustomerReviews::route('/'),
            'create' => CreateCustomerReview::route('/create'),
            'edit' => EditCustomerReview::route('/{record}/edit'),
        ];
    }
}
