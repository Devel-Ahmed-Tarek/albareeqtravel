<?php

namespace App\Filament\Resources\NewsItems\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class NewsItemsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('slug')
                    ->label('Slug')
                    ->searchable(),
                TextColumn::make('title_ar')
                    ->label('العنوان'),
                TextColumn::make('published_at')
                    ->dateTime('Y-m-d H:i')
                    ->sortable(),
                IconColumn::make('is_published')
                    ->label('ظاهر؟')
                    ->boolean(),
            ])
            ->defaultSort('published_at', 'desc')
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
