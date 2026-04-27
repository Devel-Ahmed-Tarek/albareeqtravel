<?php

namespace App\Filament\Resources\Visas\Pages;

use App\Filament\Resources\Visas\VisaResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditVisa extends EditRecord
{
    protected static string $resource = VisaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
