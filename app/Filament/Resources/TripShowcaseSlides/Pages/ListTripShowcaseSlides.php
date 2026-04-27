<?php

namespace App\Filament\Resources\TripShowcaseSlides\Pages;

use App\Filament\Resources\TripShowcaseSlides\TripShowcaseSlideResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTripShowcaseSlides extends ListRecords
{
    protected static string $resource = TripShowcaseSlideResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
