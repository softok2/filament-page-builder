<?php

declare(strict_types=1);

namespace Softok2\FilamentPageBuilder\Forms\Components;

use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\TextInput;

class Text extends CustomField
{
    protected string $view = 'filament-forms::components.group';

    public function getChildComponents(): array
    {
        return [
            Fieldset::make($this->getName())
                ->label(fn () => $this->getLabel())
                ->hiddenLabel(fn () => $this->isLabelHidden())
                ->schema([
                    TextInput::make('es')
                        ->label('Es')
                        ->visible($this->isEsInputVisible())
                        ->required($this->isEsInputRequired()),
                    TextInput::make('en')
                        ->label('En')
                        ->visible($this->isEnInputVisible())
                        ->required($this->isEnInputRequired()),
                ])->columns(),
        ];
    }
}
