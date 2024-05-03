<?php

declare(strict_types=1);

namespace Softok2\FilamentPageBuilder\Commands;

use Illuminate\Console\GeneratorCommand;

class GenerateLayoutComponentCommand extends GeneratorCommand
{
    protected $signature = 'filament-page-builder-lc:make {name}';

    protected $type = 'class';

    protected function getStub(): string
    {
        return __DIR__.'/../../stubs/LayoutComponent.php.stub';
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        return "{$rootNamespace}\\Filament\\PageBuilder\\LayoutComponents";
    }
}
