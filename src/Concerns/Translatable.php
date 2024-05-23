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

    private function translate(array | string | null $name): ?string
    {
        $value = $this[$name];

        if (is_array($value)) {
            $fallback = $value['es'] ?? $value['en'] ?? '';

            return $value[app()->getLocale()] ?? $fallback;
        }

        return $value;
    }
}
