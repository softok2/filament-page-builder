<?php

namespace Softok2\FilamentPageBuilder\Concerns;

use Illuminate\Support\Arr;

trait InteractsWithDTOTranslation
{
    private function isTranslationsArray($value): bool
    {
        $keys = ['es', 'en'];

        return count($value) === 2 && Arr::has($value, $keys);
    }

    private function translate(array | string | null $value): ?string
    {
        $fallback = $value['en'] ?? $value['es'] ?? $value;

        return $value[app()->getLocale()] ?? $fallback;
    }
}
