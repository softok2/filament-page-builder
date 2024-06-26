<?php

declare(strict_types=1);

namespace Softok2\FilamentPageBuilder\Forms\Components;

use Filament\Forms\Components\Field;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Textarea;

class TextBox extends Field
{
    protected string $view = 'filament-forms::components.group';

    protected int $rows = 4;

    protected bool $isEsInputRequired = false;

    protected bool $isEnInputRequired = false;

    public function getChildComponents(): array
    {
        return [
            Fieldset::make($this->getName())
                ->label(fn () => $this->getLabel())
                ->hiddenLabel(fn () => $this->isLabelHidden())
                ->schema([
                    Textarea::make('es')
                        ->rows($this->getRows())
                        ->label('Es')
                        ->required($this->isEsInputRequired),
                    Textarea::make('en')
                        ->rows($this->getRows())
                        ->label('En')
                        ->required($this->isEnInputRequired),
                ])->columns(),
        ];
    }

    public function getRows(): int
    {
        return $this->rows;
    }

    public function rows(int $rows): TextBox
    {
        $this->rows = $rows;

        return $this;
    }

    public function esInputRequired(bool $isEsInputRequired = true): TextBox
    {
        $this->isEsInputRequired = $isEsInputRequired;

        return $this;
    }

    public function enInputRequired(bool $isEnInputRequired = true): TextBox
    {
        $this->isEnInputRequired = $isEnInputRequired;

        return $this;
    }
}
