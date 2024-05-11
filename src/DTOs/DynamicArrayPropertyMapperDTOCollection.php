<?php

declare(strict_types=1);

namespace Softok2\FilamentPageBuilder\DTOs;

use Illuminate\Support\Collection;
use Softok2\FilamentPageBuilder\Concerns\InteractsWithDTOTranslation;

class DynamicArrayPropertyMapperDTOCollection extends Collection
{
    use InteractsWithDTOTranslation;

    public function fromDTO(): Collection
    {
        return collect($this->items)->map(function (
            array | string $item
        ) {

            if ($this->isTranslationsArray($item)) {
                return $this->translate($item);
            }

            return is_string($item) ? $item : new DynamicArrayPropertyMapperDTO($item);
        });
    }
}
