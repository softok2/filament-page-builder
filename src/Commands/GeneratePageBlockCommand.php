<?php

declare(strict_types=1);

namespace Softok2\FilamentPageBuilder\Commands;

use Illuminate\Console\GeneratorCommand;

class GeneratePageBlockCommand extends GeneratorCommand
{
    protected $signature = 'filament-page-builder-block:make {name}';

    protected $type = 'class';

    protected function getStub(): string
    {
        return __DIR__.'/../../stubs/PageBlock.php.stub';
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        return "{$rootNamespace}\\Filament\\PageBuilder\\Blocks";
    }
}
