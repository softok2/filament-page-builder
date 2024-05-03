<?php

declare(strict_types=1);

namespace Softok2\FilamentPageBuilder\Resources\BranchResource\Pages;

use Cheesegrits\FilamentGoogleMaps\Concerns\InteractsWithMaps;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ManageRecords;
use Illuminate\Database\Eloquent\Builder;
use Softok2\FilamentPageBuilder\Resources\BranchResource;

class ManageBranches extends ManageRecords
{
    use InteractsWithMaps;

    protected static string $resource = BranchResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'Todos' => Tab::make(),
            'USA' => Tab::make()
                ->modifyQueryUsing(fn (
                    Builder $query
                ) => $query->where('country', 'United States')),
            'MÉXICO' => Tab::make()
                ->modifyQueryUsing(fn (
                    Builder $query
                ) => $query->where('country', 'Mexico')),
        ];
    }
}
