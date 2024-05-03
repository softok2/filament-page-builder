<?php

declare(strict_types=1);

namespace Softok2\FilamentPageBuilder;

use Filament\Support\Assets\Js;
use Filament\Support\Assets\Css;
use Filament\Support\Assets\Asset;
use Illuminate\Filesystem\Filesystem;
use Spatie\LaravelPackageTools\Package;
use Filament\Support\Facades\FilamentIcon;
use Filament\Support\Facades\FilamentAsset;
use Filament\Support\Assets\AlpineComponent;
use Livewire\Features\SupportTesting\Testable;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Softok2\FilamentPageBuilder\Testing\TestsFilamentPageBuilder;
use Softok2\FilamentPageBuilder\Commands\GeneratePageBlockCommand;
use Softok2\FilamentPageBuilder\Commands\FilamentPageBuilderCommand;
use Softok2\FilamentPageBuilder\Commands\GenerateLayoutComponentCommand;

class FilamentPageBuilderServiceProvider extends PackageServiceProvider
{
    public static string $name = 'filament-page-builder';

    public static string $viewNamespace = 'filament-page-builder';

    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package->name(static::$name)
            ->hasCommands($this->getCommands())
            ->hasInstallCommand(function (InstallCommand $command) {
                $command
                    ->publishConfigFile()
                    ->publishMigrations()
                    ->askToRunMigrations()
                    ->askToStarRepoOnGitHub('softok2/filament-page-builder')
                    ->startWith(function (InstallCommand $command) {
                        $this->generatePageBlocks($command)
                            ->generateLayoutComponents($command)
                            ->publishSeeders($command);
                    });
            });

        $configFileName = $package->shortName();

        if (file_exists($package->basePath("/../config/{$configFileName}.php"))) {
            $package->hasConfigFile();
        }

        if (file_exists($package->basePath('/../database/migrations'))) {
            $package->hasMigrations($this->getMigrations());
        }

        if (file_exists($package->basePath('/../resources/lang'))) {
            $package->hasTranslations();
        }

        if (file_exists($package->basePath('/../database/seeders'))) {
            $this->publishes([
                __DIR__.'/../database/seeders/PageSeeder.php' => database_path('seeders/PageSeeder.php'),
                __DIR__.'/../database/seeders/LayoutComponentSeeder.php' => database_path('seeders/LayoutComponentSeeder.php'),
            ], 'page-builder-seeds');
        }

        if (file_exists($package->basePath('/../resources/views'))) {
            $package->hasViews(static::$viewNamespace);
        }
    }

    public function packageRegistered(): void
    {
    }

    public function packageBooted(): void
    {
        // Asset Registration
        FilamentAsset::register(
            $this->getAssets(),
            $this->getAssetPackageName()
        );

        FilamentAsset::registerScriptData(
            $this->getScriptData(),
            $this->getAssetPackageName()
        );

        // Icon Registration
        FilamentIcon::register($this->getIcons());

        // Handle Stubs
        if (app()->runningInConsole()) {
            foreach (app(Filesystem::class)->files(__DIR__.'/../stubs/') as $file) {
                $this->publishes([
                    $file->getRealPath() => base_path("stubs/filament-page-builder/{$file->getFilename()}"),
                ], 'filament-page-builder-stubs');
            }
        }

        // Testing
        Testable::mixin(new TestsFilamentPageBuilder());
    }

    protected function getAssetPackageName(): ?string
    {
        return 'softok2/filament-page-builder';
    }

    /**
     * @return array<Asset>
     */
    protected function getAssets(): array
    {
        return [
            // AlpineComponent::make('filament-page-builder', __DIR__ . '/../resources/dist/components/filament-page-builder.js'),
            Css::make(
                'filament-page-builder-styles',
                __DIR__.'/../resources/dist/filament-page-builder.css'
            ),
            Js::make(
                'filament-page-builder-scripts',
                __DIR__.'/../resources/dist/filament-page-builder.js'
            ),
        ];
    }

    /**
     * @return array<class-string>
     */
    protected function getCommands(): array
    {
        return [
            FilamentPageBuilderCommand::class,
            GeneratePageBlockCommand::class,
            GenerateLayoutComponentCommand::class,
        ];
    }

    /**
     * @return array<string>
     */
    protected function getIcons(): array
    {
        return [];
    }

    protected function generatePageBlocks(InstallCommand $command): self
    {
        $command->comment('Generating blocks...');

        $blocks = [
            'HomeBlock',
            'ContactBlock',
            'AboutUsBlock',
            'PrivacyPolicyBlock',
            'BlogBlock',
        ];
        foreach ($blocks as $block) {
            $command->call(
                'filament-page-builder-block:make',
                ['name' => $block]
            );
        }

        $command->info('Blocks generated successfully');

        return $this;
    }

    protected function publishSeeders(InstallCommand $command): self
    {
        $command->comment('Publishing the seeders...');

        $command->call('vendor:publish', [
            '--tag' => 'page-builder-seeds',
            '--force' => true,
        ]);

        $command->info('Seeders published successfully');

        return $this;
    }

    /**
     * @return array<string>
     */
    protected function getRoutes(): array
    {
        return [];
    }

    /**
     * @return array<string, mixed>
     */
    protected function getScriptData(): array
    {
        return [];
    }

    /**
     * @return array<string>
     */
    protected function getMigrations(): array
    {
        return [
            'create_layout_components_table',
            'create_pages_table',
            'create_posts_table',
            'create_metas_table',
        ];
    }

    protected function generateLayoutComponents(InstallCommand $command): self
    {
        $command->comment('Generating layouts components...');

        $components = [
            'HeaderComponent',
            'FooterComponent',
        ];

        foreach ($components as $component) {
            $command->call(
                'filament-page-builder-lc:make',
                ['name' => $component]
            );
        }

        $command->info('Layout components generated successfully');

        return $this;
    }
}
