<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Author;
use App\Models\Book;
use App\Models\BookFormat;
use App\Models\PublishedBook;
use App\Models\Publisher;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name'  => 'Test User',
            'email' => 'test@example.com',
        ]);

        User::factory(10)->create();

        $publishers = Publisher::factory()->count(5)->create();
        $authors = Author::factory()->count(20)->create();
        $formats = BookFormat::factory()->count(3)->create();

        // Create 10 published books, the related books will have between 1 and 3 existing authors
        // Publisher and format will be taken randomly from the previously created ones
        PublishedBook::factory()
            ->count(10)
            ->withRandomPublisherIn($publishers)
            ->withRandomFormatIn($formats)
            ->sequence(
                fn(Sequence $sequence) => [
                    'book_id' => Book::factory()->withRandomAuthors(1, 3, $authors)->create()->id
                ]
            )
            ->create();
    }
}
