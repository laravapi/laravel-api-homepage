<?php

namespace App\Filament\Resources\ApiResource\Pages;

use App\Filament\Resources\ApiResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewApi extends ViewRecord
{
    protected static string $resource = ApiResource::class;

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
