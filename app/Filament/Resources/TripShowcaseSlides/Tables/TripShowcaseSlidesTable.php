<?php

namespace App\Filament\Resources\TripShowcaseSlides\Tables;

use App\Models\TripShowcaseSlide;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TripShowcaseSlidesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('sort_order')
                    ->label('الترتيب')
                    ->sortable()
                    ->alignCenter(),
                TextColumn::make('title_ar')
                    ->label('العنوان (ع)')
                    ->searchable()
                    ->limit(36),
                ImageColumn::make('thumb')
                    ->label('صورة')
                    ->getStateUsing(fn (TripShowcaseSlide $r): string => $r->resolvedImageUrl())
                    ->square()
                    ->height(40),
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
