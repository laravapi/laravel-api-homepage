<?php

namespace App\Filament\Resources\ApiResource\Pages;

use App\Filament\Resources\ApiResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListApis extends ListRecords
{
    protected static string $resource = ApiResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
