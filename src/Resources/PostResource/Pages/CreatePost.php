<?php

namespace Softok2\FilamentPageBuilder\Resources\PostResource\Pages;

use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Str;
use Softok2\FilamentPageBuilder\Resources\PostResource;

class CreatePost extends CreateRecord
{

    protected static string $resource = PostResource::class;

    protected function getHeaderActions(): array
    {
        return [
//            Actions\LocaleSwitcher::make(),
        ];
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['slug_en'] = Str::slug($data['title_en']);
        $data['slug_es'] = Str::slug($data['title_es']);

        return $data;
    }

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title(__('Article Registered'))
            ->body(__('The article has been created successfully'));
    }
}
