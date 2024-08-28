<?php

declare(strict_types=1);

namespace Softok2\FilamentPageBuilder\Forms\Components;

use Filament\Forms\Components\Field;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Textarea;

class TextBox extends CustomField
{
    protected string $view = 'filament-forms::components.group';

    protected int $rows = 4;

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
                        ->visible($this->isEsInputVisible())
                        ->required($this->isEsInputRequired()),
                    Textarea::make('en')
                        ->rows($this->getRows())
                        ->label('En')
                        ->hidden($this->isEnInputVisible())
                        ->required($this->isEnInputRequired()),
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
}
