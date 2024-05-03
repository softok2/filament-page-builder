<?php

declare(strict_types=1);

namespace Softok2\FilamentPageBuilder\Resources\LayoutComponentResource\Pages;

use Filament\Resources\Pages\EditRecord;
use Softok2\FilamentPageBuilder\Resources\LayoutComponentResource;

class EditComponentLayout extends EditRecord
{
    protected static string $resource = LayoutComponentResource::class;

    protected function getHeaderActions(): array
    {
        return [
        ];
    }

    public function getHeading(): string
    {
        return trans('filament-page-builder::page-builder.edit-component', ['component' => $this->record->name]);
    }
}
