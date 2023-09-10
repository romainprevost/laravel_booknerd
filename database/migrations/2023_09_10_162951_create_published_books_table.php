<?php

use App\Models\Book;
use App\Models\BookFormat;
use App\Models\Publisher;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('published_books', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Book::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Publisher::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(BookFormat::class)->constrained()->cascadeOnDelete();
            $table->string('cover');
            $table->string('language', 4);
            $table->date('published_on');
            $table->unsignedInteger('pages_count')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('published_books');
    }
};
