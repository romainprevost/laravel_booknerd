<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\BookFormat;
use App\Models\PublishedBook;
use App\Models\Publisher;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Collection;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PublishedBook>
 */
class PublishedBookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'book_id' => Book::factory(),
            'publisher_id' => Publisher::factory(),
            'book_format_id' => BookFormat::factory(),
            'cover' => 'https://placehold.co/600x400',
            'language' => fake()->languageCode,
            'published_on' => fake()->date,
            'pages_count' => fake()->numberBetween(100, 900)
        ];
    }

    public function withRandomPublisherIn(Collection $publishers): Factory|PublishedBookFactory
    {
        return $this->state(fn($attributes) => [
            'publisher_id' => $publishers->random()->id
        ]);
    }

    public function withRandomFormatIn(Collection $formats): Factory|PublishedBookFactory
    {
        return $this->state(fn($attributes) => [
            'book_format_id' => $formats->random()->id
        ]);
    }
}
