<?php

declare(strict_types=1);

namespace Softok2\FilamentPageBuilder\Forms\Components;

use Filament\Forms\Components\Group;
use Filament\Forms\Components\Repeater;

class Slider extends Repeater
{
    protected string $view = 'filament-forms::components.repeater.index';

    protected bool $isCircular = false;

    private string $fileUploadDirectory = 'uploads';

    protected bool $isFull = false;

    public function getChildComponents(): array
    {
        $schema = [
            Group::make([
                ImageUpload::make('image')
                    ->avatarMode($this->isCircular())
                    ->directory($this->getFileUploadDirectory()),
            ]),
        ];

        if ($this->isFull()) {
            $schema[] =
                Group::make([
                    Text::make('title'),
                    TextBox::make('description'),
                ]);
        }

        return $schema;
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->grid($this->isFull() ? 1 : 2)
            ->cloneable()
            ->collapsible()
            ->defaultItems(3);
    }

    public function isCircular(): bool
    {
        return $this->isCircular;
    }

    public function setIsCircular(bool $condition): Slider
    {
        $this->isCircular = $condition;

        return $this;
    }

    public function getFileUploadDirectory(): string
    {
        return $this->fileUploadDirectory;
    }

    public function setFileUploadDirectory(string $fileUploadDirectory): Slider
    {
        $this->fileUploadDirectory = $fileUploadDirectory;

        return $this;
    }

    public function isFull(): bool
    {
        return $this->isFull;
    }

    public function full(): Slider
    {
        $this->isFull = true;

        return $this;
    }
}
