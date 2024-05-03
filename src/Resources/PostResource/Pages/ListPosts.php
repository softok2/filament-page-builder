<?php

namespace Softok2\FilamentPageBuilder\Resources\PostResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Softok2\FilamentPageBuilder\Resources\PostResource;

class ListPosts extends ListRecords
{
    protected static string $resource = PostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
