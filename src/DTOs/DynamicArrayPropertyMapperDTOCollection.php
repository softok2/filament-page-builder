<?php

declare(strict_types=1);

namespace Softok2\FilamentPageBuilder\DTOs;

use Illuminate\Support\Collection;

class DynamicArrayPropertyMapperDTOCollection extends Collection
{
    public function fromDTO(): Collection
    {
        return collect($this->items)->map(function (
            array | string $item
        ) {
            return is_string($item) ? $item : new DynamicArrayPropertyMapperDTO($item);
        });
    }
}
