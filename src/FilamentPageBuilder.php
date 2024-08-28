<?php

declare(strict_types=1);

namespace Softok2\FilamentPageBuilder;

use Filament\Contracts\Plugin;
use Filament\Panel;
use Softok2\FilamentPageBuilder\Resources\LayoutComponentResource;
use Softok2\FilamentPageBuilder\Resources\PageResource;
use Softok2\FilamentPageBuilder\Resources\PostResource;

class FilamentPageBuilder implements Plugin
{
    protected bool $withPosts = false;

    protected array $blocksMapper = [];

    protected array $layoutsComponentsMapper = [];

    public static function make(): static
    {
        return new static;
    }

    public function getId(): string
    {
        return 'softok2/filament-page-builder';
    }

    public function register(Panel $panel): void
    {
        $resources = [
            PageResource::class,
            LayoutComponentResource::class,
        ];

        if ($this->withPosts) {
            $resources[] = PostResource::class;
        }

        $panel->resources($resources);
    }

    public function boot(Panel $panel): void
    {
        // TODO: Implement boot() method.
    }

    public function withPosts(bool $withPosts = true): FilamentPageBuilder
    {
        $this->withPosts = $withPosts;

        return $this;
    }

    public function getBlocksMapper(): array
    {
        return $this->blocksMapper;
    }

    public function blocksMapper(array $blocksMapper): static
    {
        $this->blocksMapper = $blocksMapper;

        return $this;
    }

    public function layoutsComponentsMapper(
        array $layoutsComponentsMapper
    ): FilamentPageBuilder {
        $this->layoutsComponentsMapper = $layoutsComponentsMapper;

        return $this;
    }

    public function getLayoutsComponentsMapper(): array
    {
        return $this->layoutsComponentsMapper;
    }
}
