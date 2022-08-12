<?php

namespace App\Filament\Resources\ApiResource\Pages;

use App\Filament\Resources\ApiResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateApi extends CreateRecord
{
    protected static string $resource = ApiResource::class;
}
