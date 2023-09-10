<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Tag extends Model
{
    use HasFactory;

    public function books(): MorphToMany
    {
        return $this->morphedByMany(Book::class, 'taggable');
    }

    public function authors(): MorphToMany
    {
        return $this->morphedByMany(Author::class, 'taggable');
    }
}
