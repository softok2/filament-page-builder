<?php

declare(strict_types=1);

namespace Softok2\FilamentPageBuilder\Commands;

use Illuminate\Console\Command;

class FilamentPageBuilderCommand extends Command
{
    public $signature = 'filament-page-builder:install';

    public $description = 'Create initial pages blocks and layouts components for Filament Page Builder.';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
