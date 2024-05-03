<?php

namespace Softok2\FilamentPageBuilder\Resources\PostResource\Pages;

use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Str;
use Softok2\FilamentPageBuilder\Resources\PostResource;

class EditPost extends EditRecord
{
    protected static string $resource = PostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            //            Actions\LocaleSwitcher::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['slug_en'] = Str::slug($data['title_en']);
        $data['slug_es'] = Str::slug($data['title_es']);

        return $data;
    }

    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title(__('Article Updated'))
            ->body(__('The article has been updated successfully'));
    }
}
