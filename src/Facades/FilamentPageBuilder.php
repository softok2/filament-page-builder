<?php

namespace Softok2\FilamentPageBuilder\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Softok2\FilamentPageBuilder\FilamentPageBuilder
 */
class FilamentPageBuilder extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Softok2\FilamentPageBuilder\FilamentPageBuilder::class;
    }
}
