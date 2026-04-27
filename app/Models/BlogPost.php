<?php

namespace App\Models;

use App\Models\Concerns\HasBilingualFields;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    use HasBilingualFields;

    protected $fillable = [
        'slug',
        'image',
        'is_published',
        'published_at',
        'title_ar',
        'title_en',
        'excerpt_ar',
        'excerpt_en',
        'body_ar',
        'body_en',
    ];

    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
            'published_at' => 'datetime',
        ];
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query
            ->where('is_published', true)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    }
}
