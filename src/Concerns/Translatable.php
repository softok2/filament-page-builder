<?php

declare(strict_types=1);

namespace Softok2\FilamentPageBuilder\Concerns;

use Throwable;

trait Translatable
{
    /**
     * @throws Throwable
     */
    public function __get($name)
    {
        throw_if(
            ! property_exists($this, 'translatable'),
            'Property translatable does not exist in ' . __CLASS__ . ' class'
        );

        if (in_array($name, $this->translatable)) {
            return $this->translate($name);
        }

        return get_parent_class(__CLASS__) ? parent::__get($name) : null;
    }

    private function translate(array | string | null $value): ?string
    {
        if (! is_array($value)) {
            return $value;
        }

        $fallback = $value['en'] ?? $value['es'] ?? null;

        return $value[app()->getLocale()] ?? $fallback;
    }
}
