<?php

namespace Softok2\FilamentPageBuilder\Forms\Components;

use Filament\Forms\Components\Repeater;

class CustomRepeater extends Repeater
{
    protected bool $isEsInputRequired = true;

    protected bool $isEnInputRequired = false;

    protected bool $isEsInputVisible = true;

    public function isEsInputRequired(): bool
    {
        return $this->isEsInputRequired;
    }

    public function isEnInputRequired(): bool
    {
        return $this->isEnInputRequired;
    }

    public function isEsInputVisible(): bool
    {
        return $this->isEsInputVisible;
    }

    public function isEnInputVisible(): bool
    {
        return $this->isEnInputVisible;
    }

    protected bool $isEnInputVisible = false;

    public function esInputRequired(bool $isEsInputRequired = true): static
    {
        $this->isEsInputRequired = $isEsInputRequired;

        return $this;
    }

    public function enInputRequired(bool $isEnInputRequired = true): static
    {
        $this->isEnInputRequired = $isEnInputRequired;

        return $this;
    }

    public function esInputVisible(bool $isEsInputVisible = true): static
    {
        $this->isEsInputVisible = $isEsInputVisible;

        return $this;
    }

    public function enInputVisible(bool $isEnInputVisible = true): static
    {
        $this->isEnInputVisible = $isEnInputVisible;

        return $this;
    }
}
