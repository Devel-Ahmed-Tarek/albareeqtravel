<?php

namespace App\Filament\Resources\SiteTranslations\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SiteTranslationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('key')->searchable()->sortable()->label('Key')->wrap(),
                TextColumn::make('group')->badge()->label('Group'),
                IconColumn::make('is_active')->boolean()->label('Active'),
                TextColumn::make('updated_at')->since()->label('Updated'),
            ])
            ->defaultSort('updated_at', 'desc')
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
