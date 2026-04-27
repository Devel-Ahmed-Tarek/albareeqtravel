<?php

namespace App\Filament\Resources\HotelShowcaseSlides\Pages;

use App\Filament\Resources\HotelShowcaseSlides\HotelShowcaseSlideResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListHotelShowcaseSlides extends ListRecords
{
    protected static string $resource = HotelShowcaseSlideResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
