<?php

namespace App\Filament\Resources\SiteSettings\Tables;

use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SiteSettingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('logo_path')
                    ->label('Logo')
                    ->disk('public')
                    ->square()
                    ->height(36),
                TextColumn::make('phone_primary')->label('Phone')->searchable(),
                TextColumn::make('whatsapp_number')->label('WhatsApp'),
                TextColumn::make('updated_at')->label('Updated')->since(),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->paginated(false);
    }
}
