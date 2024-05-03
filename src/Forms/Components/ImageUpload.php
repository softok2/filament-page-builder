<?php

declare(strict_types=1);

namespace Softok2\FilamentPageBuilder\Forms\Components;

use Filament\Forms\Components\Field;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\FileUpload;

class ImageUpload extends Field
{
    protected string $view = 'filament-forms::components.group';

    protected string $directory = 'uploads';

    protected bool $avatarMode = false;

    public function getChildComponents(): array
    {
        $fileUpload = FileUpload::make('path')
            ->label(__('Image'))
            ->nullable(false)
            ->columnSpanFull()
            ->disk('public')
            ->directory($this->directory)
            ->visibility('private')
            ->image()
            ->maxSize(10 * 1024)
            ->nullable()
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
                        ->translateLabel(),
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
}
