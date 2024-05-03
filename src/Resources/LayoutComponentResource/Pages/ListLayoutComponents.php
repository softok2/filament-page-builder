<?php

declare(strict_types=1);

namespace Softok2\FilamentPageBuilder\Resources\LayoutComponentResource\Pages;

use Filament\Resources\Pages\ListRecords;
use Softok2\FilamentPageBuilder\Resources\LayoutComponentResource;

class ListLayoutComponents extends ListRecords
{
    protected static string $resource = LayoutComponentResource::class;

    protected function getHeaderActions(): array
    {
        return [

        ];
    }
}
