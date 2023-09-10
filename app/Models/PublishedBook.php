<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PublishedBook extends Model
{
    use HasFactory;

    protected $casts = [
        'published_on' => 'date'
    ];

    protected $with = ['book', 'publisher', 'format'];

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

    public function publisher(): BelongsTo
    {
        return $this->belongsTo(Publisher::class);
    }

    public function format(): BelongsTo
    {
        return $this->belongsTo(BookFormat::class, 'book_format_id');
    }
}
