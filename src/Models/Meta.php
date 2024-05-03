<?php

declare(strict_types=1);

namespace Softok2\FilamentPageBuilder\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Softok2\FilamentPageBuilder\Concerns\Translatable;

class Meta extends Model
{
    use Translatable;

    /**
     * @var array<string>
     */
    protected array $translatable = ['title', 'description', 'keywords'];

    protected $guarded = [];

    protected $casts = [
        'keywords_es' => 'array',
        'keywords_en' => 'array',
    ];

    public function metaable(): MorphTo
    {
        return $this->morphTo();
    }
}
