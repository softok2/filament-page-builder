<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Softok2\FilamentPageBuilder\Models\Page;

class PageSeeder extends Seeder
{
    public static array $pages = [];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pages = array_merge(static::$pages, [
            $this->getHomePage(),
            $this->getBlogPage(),
            $this->getAboutPage(),
            $this->getContactPage(),
            $this->getPrivacyPage(),
        ]);

        foreach ($pages as $page) {
            Page::firstOrCreate(
                Arr::only(
                    $page,
                    ['name']
                ),
                Arr::only(
                    $page,
                    ['slug', 'title', 'meta']
                ),
            );
        }
    }

    protected function getHomePage(): array
    {
        return [
            'name' => 'home',
            'title' => [
                'es' => 'Inicio',
                'en' => 'Home',
            ],
            'slug' => [
                'es' => 'inicio',
                'en' => 'home',
            ],
            'meta' => [
                'title' => [
                    'es' => 'Inicio',
                    'en' => 'Home',
                ],
                'description' => [
                    'es' => 'Descripción de la página de inicio',
                    'en' => 'Home page description',
                ],
                'keywords' => [
                    'es' => [
                        'inicio',
                        'página',
                        'descripción',
                    ],
                    'en' => [
                        'home',
                        'page',
                        'description',
                    ],
                ],
            ],
        ];
    }

    protected function getBlogPage(): array
    {
        return [
            'name' => 'blog',
            'title' => [
                'es' => 'Blog',
                'en' => 'Blog',
            ],
            'slug' => [
                'es' => 'blog',
                'en' => 'blog',
            ],
            'meta' => [
                'title' => [
                    'es' => 'Blog',
                    'en' => 'Blog',
                ],
                'description' => [
                    'es' => 'Descripción de la página de blog',
                    'en' => 'Blog page description',
                ],
                'keywords' => [
                    'es' => [
                        'blog',
                        'página',
                        'descripción',
                    ],
                    'en' => [
                        'blog',
                        'page',
                        'description',
                    ],
                ],
            ],
        ];
    }

    protected function getAboutPage(): array
    {
        return [
            'name' => 'about-us',
            'title' => [
                'es' => 'Nosotros',
                'en' => 'About Us',
            ],
            'slug' => [
                'es' => 'nosotros',
                'en' => 'about-Us',
            ],
            'meta' => [
                'title' => [
                    'es' => 'Nosotros',
                    'en' => 'About Us',
                ],
                'description' => [
                    'es' => 'Descripción de la página de nosotros',
                    'en' => 'About us page description',
                ],
                'keywords' => [
                    'es' => [
                        'nosotros',
                        'página',
                        'descripción',
                    ],
                    'en' => [
                        'about us',
                        'page',
                        'description',
                    ],
                ],
            ],
        ];
    }

    protected function getContactPage(): array
    {
        return [
            'name' => 'contact',
            'title' => [
                'es' => 'Contacto',
                'en' => 'Contact',
            ],
            'slug' => [
                'es' => 'contacto',
                'en' => 'contact',
            ],
            'meta' => [
                'title' => [
                    'es' => 'Contacto',
                    'en' => 'Contact',
                ],
                'description' => [
                    'es' => 'Descripción de la página de contacto',
                    'en' => 'Contact page description',
                ],
                'keywords' => [
                    'es' => [
                        'contacto',
                        'página',
                        'descripción',
                    ],
                    'en' => [
                        'contact',
                        'page',
                        'description',
                    ],
                ],
            ],
        ];
    }

    protected function getPrivacyPage(): array
    {
        return [
            'name' => 'privacy-policy',
            'title' => [
                'es' => 'Política de privacidad',
                'en' => 'Privacy Policy',
            ],
            'slug' => [
                'es' => 'política-de-privacidad',
                'en' => 'privacy-policy',
            ],
            'meta' => [
                'title' => [
                    'es' => 'Política de privacidad',
                    'en' => 'Privacy Policy',
                ],
                'description' => [
                    'es' => 'Descripción de la página de política de privacidad',
                    'en' => 'Privacy policy page description',
                ],
                'keywords' => [
                    'es' => [
                        'política de privacidad',
                        'página',
                        'descripción',
                    ],
                    'en' => [
                        'privacy policy',
                        'page',
                        'description',
                    ],
                ],
            ],
        ];
    }
}
