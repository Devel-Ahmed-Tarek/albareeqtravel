<?php

namespace App\Filament\Resources\CustomerReviews\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CustomerReviewsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('sort_order')
                    ->label('الترتيب')
                    ->sortable()
                    ->alignCenter(),
                TextColumn::make('name_ar')
                    ->label('الاسم (ع)')
                    ->searchable()
                    ->limit(28),
                TextColumn::make('rating')
                    ->label('النجوم')
                    ->alignCenter(),
                IconColumn::make('is_active')
                    ->label('مفعّل')
                    ->boolean(),
            ])
            ->defaultSort('sort_order')
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
