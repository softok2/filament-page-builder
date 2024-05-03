<?php

declare(strict_types=1);

namespace Softok2\FilamentPageBuilder\Models;

use App\Jobs\GenerateSitemap;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Softok2\FilamentPageBuilder\DTOs\DynamicArrayPropertyMapperDTO;

class Post extends Model
{
    protected $casts = [
        'body' => 'json',
        'cover_image' => 'json',
    ];

    protected $guarded = [];

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::saved(fn () => GenerateSitemap::dispatch());
    }

    protected function getCoverImageAsDynamicDtoAttribute(
    ): ?DynamicArrayPropertyMapperDTO {
        return new DynamicArrayPropertyMapperDTO($this->cover_image[0] ?? []);
    }

    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }
}
