<?php

declare(strict_types=1);

namespace Softok2\FilamentPageBuilder\Forms\LegacyComponents;

abstract class LayoutComponent
{
    abstract public function __invoke(): array;
}
