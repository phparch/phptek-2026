<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sponsor>
 */
class SponsorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->company();

        return [
            'uuid' => (string) Str::uuid(),
            'name' => $name,
            'website' => fake()->url(),
            'slug' => Str::slug($name),
            'logo' => 'images/sponsors/'.Str::slug($name).'.png',
            'description' => fake()->paragraph(3),
            'socials' => [
                'twitter' => '@'.Str::slug($name, ''),
                'linkedin' => 'https://linkedin.com/company/'.Str::slug($name),
            ],
        ];
    }

    /**
     * Create PHP Architect sponsor with specific data.
     */
    public function phpArchitect(): static
    {
        return $this->state(fn (array $attributes) => [
            'uuid' => '9cc0c758-efa8-45a4-8ed1-e6ecbd1f7558',
            'name' => 'PHP Architect',
            'website' => 'https://phparch.com',
            'slug' => 'php-architect',
            'logo' => 'https://cdn.phparch.social/logos/current/orange-transparent-background.png',
            'description' => 'Published continuously since 2002, PHP Architect magazine is a technical journal dedicated exclusively to the world of PHP and web development. We are committed to spreading knowledge of best practices in PHP and supporting the PHP Community. We also produce a full line of books, host online and in-person web training, and organize one of the largest conferences every year focused on PHP and web development in the US, and offer consulting services that help companies expand and grow their products.',
            'socials' => [
                'x' => 'phparch',
                'mastodon' => '@phparch@phparch.social',
            ],
        ]);
    }
}
