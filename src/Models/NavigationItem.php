<?php

namespace Softok2\FilamentPageBuilder\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class NavigationItem extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = ['name', 'path'];

    public $translatable = ['name', 'path'];
}
