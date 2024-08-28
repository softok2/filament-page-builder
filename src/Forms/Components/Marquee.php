<?php

declare(strict_types=1);

namespace Softok2\FilamentPageBuilder\Forms\Components;

class Marquee extends CustomRepeater
{
    protected string $view = 'filament-forms::components.repeater.index';

    public function getChildComponents(): array
    {
        return [
            Text::make('title')
                ->esInputVisible($this->isEsInputVisible())
                ->esInputRequired($this->isEsInputRequired())
                ->enInputVisible($this->isEnInputVisible())
                ->enInputRequired($this->isEnInputRequired()),
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
