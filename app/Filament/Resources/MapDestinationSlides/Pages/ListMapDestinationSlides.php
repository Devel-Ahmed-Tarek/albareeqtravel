<?php

namespace App\Filament\Resources\MapDestinationSlides\Pages;

use App\Filament\Resources\MapDestinationSlides\MapDestinationSlideResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMapDestinationSlides extends ListRecords
{
    protected static string $resource = MapDestinationSlideResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
