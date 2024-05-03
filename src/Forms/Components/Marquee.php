<?php

declare(strict_types=1);

namespace Softok2\FilamentPageBuilder\Forms\Components;

use Filament\Forms\Components\Repeater;

class Marquee extends Repeater
{
    protected string $view = 'filament-forms::components.repeater.index';

    public function getChildComponents(): array
    {
        return [
            Text::make('title'),
        ];
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->grid()
            ->cloneable()
            ->collapsible()
            ->defaultItems(3);
    }
}
