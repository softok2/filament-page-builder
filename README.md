    # Filament tool for improve management of pages content speed and easy

[![Latest Version on Packagist](https://img.shields.io/packagist/v/softok2/filament-page-builder.svg?style=flat-square)](https://packagist.org/packages/softok2/filament-page-builder)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/softok2/filament-page-builder/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/softok2/filament-page-builder/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/softok2/filament-page-builder/fix-php-code-styling.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/softok2/filament-page-builder/actions?query=workflow%3A"Fix+PHP+code+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/softok2/filament-page-builder.svg?style=flat-square)](https://packagist.org/packages/softok2/filament-page-builder)



This package comes with predefined form components that can be used to build a page:
* Text
* ImageUpload
* TextBox
* Marquee
* Slider

## Installation

You can install the package via composer:

```bash
composer require softok2/filament-page-builder
```

You can set up all the necessary files by running the following command:

```bash
php artisan filament-page-builder:install
```

### And it is ready to use!!

## Usage

### Its recommended to run migrations and seeders to get the default components and pages.

```bash
php artisan migrate --seed
```


The packages come with a predefined page blocks and layout components in ```App//Filament//PageBuilder``` .
Page blocks look like this:

```php
class HomeBlock extends PageBlock
{
    const HEADER_SECTION = 'header_section';

    public static string $fileUploadDirectory = 'uploads/pages/';

    public function headerSection(): Block
    {
        return Block::make(self::HEADER_SECTION)->label(__('Header Section'))
            ->schema([
                Text::make('title'),
                ImageUpload::make('background'),
            ])->maxItems(1);
    }
}
```
Define your own section per page declaring a method with the name  and de ```Section``` suffix. 


Include the plugins in your admin panel:

```php
...
   ->plugins([
        FilamentPageBuilder::make()
])
```

## Customization

Yoy can define your own blocks and components by creating both classes and mapping them in the plugin configuration.


For create a new block you can run the following command:

```bash
php artisan filament-page-builder-block:make HistoryBlock
```

For create a new layout component you can run the following command:

```bash
php artisan filament-page-builder-lc:make HeroComponent
```

Then you can map the new blocks and components in the plugin configuration:

```php
FilamentPageBuilder::make()
            ->withPosts()
            ->blocksMapper([
                'history' => HistoryBlock::class,
            ])
            ->layoutsComponentsMapper([
                'hero' => HeroComponent::class,
            ])
```

In the example above, 'history' and 'hero' are the name of the page and component respectively.
You can easly add them in the seeders:
* PageSeeder.php
* LayoutComponentSeeder.php

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Franky](https://github.com/softok2)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
