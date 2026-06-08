<?php

namespace App\Filament\Resources\SiteSettings\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class SiteSettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Branding')
                    ->schema([
                        FileUpload::make('logo_path')
                            ->image()
                            ->disk('public')
                            ->directory('site-config')
                            ->visibility('public')
                            ->imagePreviewHeight('100')
                            ->label('Logo'),
                        FileUpload::make('favicon_path')
                            ->image()
                            ->disk('public')
                            ->directory('site-config')
                            ->visibility('public')
                            ->imagePreviewHeight('64')
                            ->label('Favicon'),
                    ])
                    ->columns(2),
                Section::make('Contact')
                    ->schema([
                        TextInput::make('phone_primary')->tel()->maxLength(64)->label('Primary phone'),
                        TextInput::make('phone_secondary')->tel()->maxLength(64)->label('Secondary phone'),
                        TextInput::make('whatsapp_number')
                            ->maxLength(32)
                            ->label('WhatsApp number')
                            ->helperText('Example: 966532352749'),
                        TextInput::make('contact_email')->email()->maxLength(255)->label('Contact email'),
                    ])
                    ->columns(2),
                Section::make('Social links')
                    ->schema([
                        TextInput::make('social_facebook')->url()->maxLength(2048)->label('Facebook URL'),
                        TextInput::make('social_instagram')->url()->maxLength(2048)->label('Instagram URL'),
                        TextInput::make('social_snapchat')->url()->maxLength(2048)->label('Snapchat URL'),
                        TextInput::make('social_x')->url()->maxLength(2048)->label('X / Twitter URL'),
                        TextInput::make('social_linkedin')->url()->maxLength(2048)->label('LinkedIn URL'),
                        TextInput::make('social_tiktok')->url()->maxLength(2048)->label('TikTok URL'),
                        TextInput::make('social_youtube')->url()->maxLength(2048)->label('YouTube URL'),
                    ])
                    ->columns(2),
                Tabs::make('Content')
                    ->tabs([
                        Tab::make('Arabic')
                            ->schema([
                                TextInput::make('site_name_ar')->maxLength(255)->label('Site name (AR)'),
                                Textarea::make('default_meta_ar')->rows(3)->label('Default meta description (AR)'),
                            ]),
                        Tab::make('English')
                            ->schema([
                                TextInput::make('site_name_en')->maxLength(255)->label('Site name (EN)'),
                                Textarea::make('default_meta_en')->rows(3)->label('Default meta description (EN)'),
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
