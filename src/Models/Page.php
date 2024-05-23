<?php

declare(strict_types=1);

namespace Softok2\FilamentPageBuilder\Models;

use App\Filament\PageBuilder\Blocks\AboutUsBlock;
use App\Filament\PageBuilder\Blocks\BlogBlock;
use App\Filament\PageBuilder\Blocks\ContactBlock;
use App\Filament\PageBuilder\Blocks\HomeBlock;
use App\Filament\PageBuilder\Blocks\PrivacyPolicyBlock;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Softok2\FilamentPageBuilder\Concerns\InteractsWithPageContent;
use Softok2\FilamentPageBuilder\DTOs\DynamicArrayPropertyMapperDTO;
use Softok2\FilamentPageBuilder\Forms\LegacyComponents\PageBlock;
use Throwable;

class Page extends Model
{
    use InteractsWithPageContent;

    public const HOME = 'home';

    public const BLOG = 'blog';

    public const ABOUT_US = 'about-us';

    public const CONTACT = 'contact';

    public const PRIVACY = 'privacy-policy';

    /**
     * @var array<string>
     */
    protected array $translatable = ['title', 'slug'];

    protected $guarded = [];

    protected $casts = [
        'title' => 'json',
        'content' => 'json',
        'meta' => 'json',
        'slug' => 'json',
    ];

    /**
     * @throws Throwable
     */
    public function block(): PageBlock
    {
        $mapperFromPlugin = filament('softok2/filament-page-builder')->getBlocksMapper();

        $blockClass = array_merge([
            self::HOME => HomeBlock::class,
            self::BLOG => BlogBlock::class,
            self::ABOUT_US => AboutUsBlock::class,
            self::CONTACT => ContactBlock::class,
            self::PRIVACY => PrivacyPolicyBlock::class,
        ], $mapperFromPlugin)[$this->name];

        throw_if(
            ! is_subclass_of($blockClass, PageBlock::class),
            new Exception('Block must be a subclass of PageBlock')
        );

        return new $blockClass;
    }

    /**
     * @return DynamicArrayPropertyMapperDTO
     */
    public function getMetaAsDtoAttribute(): DynamicArrayPropertyMapperDTO
    {
        return new DynamicArrayPropertyMapperDTO($this->meta ?? []);
    }
}
