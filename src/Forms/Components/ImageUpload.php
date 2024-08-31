<?php

declare(strict_types=1);

namespace Softok2\FilamentPageBuilder\Forms\Components;

use Filament\Forms\Components\Field;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;

class ImageUpload extends Field
{
    protected string $view = 'filament-forms::components.group';

    protected string $directory = 'uploads';

    protected bool $avatarMode = false;

    protected bool $esAltTextRequired = false;

    protected bool $enAltTextRequired = false;

    public function getChildComponents(): array
    {
        $fileUpload = FileUpload::make('path')
            ->label(trans('filament-page-builder::page-builder.image'))
            ->nullable(false)
            ->columnSpanFull()
            ->disk('public')
            ->directory($this->directory)
            ->visibility('private')
            ->image()
            ->maxSize(10 * 1024)
            ->nullable()
            ->downloadable()
            ->columnSpanFull();

        if ($this->avatarMode) {
            $fileUpload->avatar()
                ->circleCropper()
                ->extraAttributes([
                    'class' => 'justify-center',
                ]);
        }

        return [
            Section::make(fn () => $this->getLabel() ?: null)
                ->schema([
                    $fileUpload,
                    Text::make('alt_text')
                        ->esInputRequired($this->esAltTextRequired)
                        ->enInputRequired($this->enAltTextRequired)
                        ->label(trans('filament-page-builder::page-builder.alt-text')),
                ]),
        ];
    }

    public function directory(string $directory): ImageUpload
    {
        $this->directory = $directory;

        return $this;
    }

    public function avatarMode(bool $condition): ImageUpload
    {
        $this->avatarMode = $condition;

        return $this;
    }

    public function esAltTextRequired(bool $condition = true): ImageUpload
    {
        $this->esAltTextRequired = $condition;

        return $this;
    }

    public function enAltTextRequired(bool $condition = true): ImageUpload
    {
        $this->enAltTextRequired = $condition;

        return $this;
    }
}
