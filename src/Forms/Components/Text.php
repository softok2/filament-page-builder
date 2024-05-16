<?php

declare(strict_types=1);

namespace Softok2\FilamentPageBuilder\Forms\Components;

use Filament\Forms\Components\Field;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\TextInput;

class Text extends Field
{
    protected string $view = 'filament-forms::components.group';

    protected bool $isEsInputRequired = false;

    protected bool $isEnInputRequired = false;

    public function getChildComponents(): array
    {
        return [
            Fieldset::make($this->getName())
                ->label(fn () => $this->getLabel())
                ->hiddenLabel(fn () => $this->isLabelHidden())
                ->schema([
                    TextInput::make('es')
                        ->label('Es')
                        ->required($this->isEsInputRequired),
                    TextInput::make('en')
                        ->label('En')
                        ->required($this->isEnInputRequired),
                ])->columns(),
        ];
    }

    public function esInputRequired(bool $isEsInputRequired = true): Text
    {
        $this->isEsInputRequired = $isEsInputRequired;

        return $this;
    }

    public function enInputRequired(bool $isEnInputRequired = true): Text
    {
        $this->isEnInputRequired = $isEnInputRequired;

        return $this;
    }
}
