<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Softok2\FilamentPageBuilder\Models\LayoutComponent;

class LayoutComponentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LayoutComponent::firstOrCreate([
            'name' => LayoutComponent::FOOTER,
        ], [

            'content' => [
            ],
        ]);
        LayoutComponent::firstOrCreate([
            'name' => LayoutComponent::HEADER,
        ], [

            'content' => [
            ],
        ]);
    }
}
