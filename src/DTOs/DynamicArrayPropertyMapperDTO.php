<?php

declare(strict_types=1);

namespace Softok2\FilamentPageBuilder\DTOs;

use Illuminate\Support\Arr;
use Softok2\FilamentPageBuilder\Concerns\InteractsWithDTOTranslation;

class DynamicArrayPropertyMapperDTO
{
    use InteractsWithDTOTranslation;


    protected static int $maxDepth = 10;

    public function __construct(
        array | string $data,
        int $depth = 0
    ) {

        foreach ($data as $key => $value) {

            $this->{$key} = $value;

            if (is_array($value)) {
                if (Arr::isAssoc($value)) {
                    $this->{$key} = $this->buildMapper($value, $depth);

                    continue;
                }

                $this->{$key} = (new DynamicArrayPropertyMapperDTOCollection($value))->fromDTO();
            }
        }
    }

    protected function buildMapper(
        mixed $value,
        int $depth
    ): DynamicArrayPropertyMapperDTO | string | null | array {

        if ($this->isValidArray($value) && $depth <= self::$maxDepth) {
            return new self($value, $depth + 1);
        }

        return $this->translate($value);
    }

    private function isValidArray(mixed $arr): bool
    {
        return is_array($arr) && ! $this->isTranslationsArray($arr);
    }

}
