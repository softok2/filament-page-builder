<?php

declare(strict_types=1);

namespace Softok2\FilamentPageBuilder\Forms\LegacyComponents;

use Illuminate\Support\Str;

abstract class PageBlock
{
    public static function sections(): array
    {
        $sections = [];

        $methods = array_filter(
            get_class_methods(static::class),
            fn ($method) => Str::endsWith($method, 'Section')
        );

        foreach ($methods as $method) {
            $sections[] = (new static)->$method();
        }

        return array_filter($sections);
    }

    public static function getMaxItems(): int
    {
        return count(static::sections());
    }
}
