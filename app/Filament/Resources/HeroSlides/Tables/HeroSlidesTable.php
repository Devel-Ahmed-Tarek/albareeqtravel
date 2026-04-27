<?php

namespace App\Filament\Resources\HeroSlides\Tables;

use App\Models\HeroSlide;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class HeroSlidesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('sort_order')
                    ->label('الترتيب')
                    ->sortable()
                    ->alignCenter(),
                TextColumn::make('kicker_ar')
                    ->label('فوق العنوان (ع)')
                    ->searchable()
                    ->limit(40)
                    ->placeholder('—'),
                ImageColumn::make('resolved_image')
                    ->label('صورة')
                    ->getStateUsing(fn (HeroSlide $record): string => $record->resolvedImageUrl())
                    ->square()
                    ->height(40),
                IconColumn::make('is_active')
                    ->label('مفعّل')
                    ->boolean(),
            ])
            ->defaultSort('sort_order')
            ->filters([
                //
            ])
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
