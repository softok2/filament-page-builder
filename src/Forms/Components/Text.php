<?php

declare(strict_types=1);

namespace Softok2\FilamentPageBuilder\Forms\Components;

use Filament\Forms\Components\Field;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\TextInput;

class Text extends Field
{
    protected string $view = 'filament-forms::components.group';

    public function getChildComponents(): array
    {
        return [
            Fieldset::make(__($this->getName()))
                ->hiddenLabel(fn () => ! $this->getLabel() ?? false)
                ->label($this->getLabel() ?: null)
                ->schema([
                    TextInput::make('es')
                        ->label('Es')
                        ->required(),
                    TextInput::make('en')
                        ->label('En'),
                ])->columns(),
        ];
    }
}
