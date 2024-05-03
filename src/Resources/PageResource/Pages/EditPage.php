<?php

namespace Softok2\FilamentPageBuilder\Resources\PageResource\Pages;

use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Softok2\FilamentPageBuilder\Resources\PageResource;

class EditPage extends EditRecord
{
    protected static string $resource = PageResource::class;

    protected function getHeaderActions(): array
    {
        return [
        ];
    }

    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title(__('Page Updated'))
            ->body(__('The page has been updated successfully'));
    }
}
