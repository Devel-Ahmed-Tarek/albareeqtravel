<?php

namespace App\Filament\Resources\Visas\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class VisasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('sort_order')->label('#')->sortable(),
                TextColumn::make('category.name_ar')->label('التصنيف')->toggleable(),
                TextColumn::make('country_ar')->label('الدولة')->searchable(),
                TextColumn::make('code_ar')->label('النوع'),
                TextColumn::make('price_from')->label('السعر')->money('USD'),
                TextColumn::make('discount_percent')->label('خصم')->suffix('%'),
                IconColumn::make('is_active')->label('فعّال؟')->boolean(),
            ])
            ->defaultSort('sort_order', 'asc')
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
