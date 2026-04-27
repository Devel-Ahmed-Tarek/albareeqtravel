<?php

namespace App\Filament\Resources\Visas\Pages;

use App\Filament\Resources\Visas\VisaResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListVisas extends ListRecords
{
    protected static string $resource = VisaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
