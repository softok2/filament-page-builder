<?php

declare(strict_types=1);

namespace Softok2\FilamentPageBuilder\Concerns;

use Softok2\FilamentPageBuilder\DTOs\DynamicArrayPropertyMapperDTO;

trait InteractsWithPageContent
{
    public function getContentSection($name): DynamicArrayPropertyMapperDTO
    {
        return new DynamicArrayPropertyMapperDTO(
            collect($this->content)->firstWhere('type', $name)['data'] ?? []
        );
    }

    public function allContentSections(): array
    {
        return collect($this->content)->mapWithKeys(fn (
            $section
        ) => [$section['type'] => new DynamicArrayPropertyMapperDTO($section['data'])])->toArray();
    }
}
