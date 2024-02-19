<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['title', 'slug', 'thumbnail', 'body', 'active', 'published_at', 'user_id', 'meta_title', 'meta_description'];

    protected $casts = ['published_at' => 'datetime'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function getDateFormattedDate()
    {
        return $this->published_at->format('F jS Y');
    }

    public function shortBody($words = 30): string
    {
        return \Illuminate\Support\Str::words(strip_tags($this->body), $words);
    }

    public function findInShortBody(string $search): string
    {

        return Str::excerpt($this->body, $search);
    }

    public function getThumbnail()
    {
        if (str_starts_with($this->thumbnail, 'http')) {
            return $this->thumbnail;
        }

        return '/storage/' . $this->thumbnail;
    }

    public function humanReadTime(): Attribute
    {
        return new Attribute(
            get: function ($value, $attribute) {
                $words = Str::wordCount(strip_tags($attribute['body']));

                $minutes = ceil($words / 200);

                return $minutes . ' ' . str('min')->plural($minutes) . ', ' . $words . ' ' . str('words')->plural($words);
            }
        );
    }
}
