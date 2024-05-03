<?php

namespace Softok2\FilamentPageBuilder\Resources\CustomServiceResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;
use Softok2\FilamentPageBuilder\Resources\CustomServiceResource;

class ManageCustomServices extends ManageRecords
{
    protected static string $resource = CustomServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
