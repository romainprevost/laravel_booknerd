<?php

namespace Database\Factories;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Collection;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence,
            'abstract' => fake()->paragraphs(3, true)
        ];
    }

    public function withRandomAuthors(int $min, $max, Collection $authors = null): BookFactory|Factory
    {
        return $this->afterCreating(function(Book $book) use ($min, $max, $authors) {
            $randomNumber = random_int($min, $max);
            $book->authors()->attach(
                $authors
                    ? $authors->random($randomNumber)
                    : Author::factory()->count($randomNumber)->create()
            );
        });
    }
}
