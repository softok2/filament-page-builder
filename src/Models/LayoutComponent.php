<?php

declare(strict_types=1);

namespace Softok2\FilamentPageBuilder\Models;

use App\Filament\PageBuilder\LayoutComponents\FooterComponent;
use App\Filament\PageBuilder\LayoutComponents\HeaderComponent;
use Doctrine\DBAL\Exception;
use Illuminate\Database\Eloquent\Model;
use Softok2\FilamentPageBuilder\DTOs\DynamicArrayPropertyMapperDTO;
use Throwable;

class LayoutComponent extends Model
{
    const FOOTER = 'footer';

    const HEADER = 'header';

    protected $guarded = [];

    protected $casts = [
        'content' => 'array',
    ];

    protected function getContentAsDynamicDtoAttribute(
    ): DynamicArrayPropertyMapperDTO {
        return new DynamicArrayPropertyMapperDTO($this->content[0] ?? []);
    }

    /**
     * @throws Throwable
     */
    public function resourceFormSchema(): array
    {
        $mapperFromPlugin = filament('softok2/filament-page-builder')->getLayoutsComponentsMapper();

        $formClass = array_merge([
            self::HEADER => HeaderComponent::class,
            self::FOOTER => FooterComponent::class,
        ], $mapperFromPlugin)[$this->name];

        throw_if(
            ! method_exists($formClass, '__invoke'),
            new Exception('Form class must have __invoke method.')
        );

        return (new $formClass)();
    }
}
