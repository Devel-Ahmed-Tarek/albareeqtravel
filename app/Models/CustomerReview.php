<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class CustomerReview extends Model
{
    protected $fillable = [
        'sort_order',
        'is_active',
        'rating',
        'quote_ar',
        'quote_en',
        'name_ar',
        'name_en',
        'from_city_ar',
        'from_city_en',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function scopeActiveOrdered(Builder $query): Builder
    {
        return $query
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('id');
    }

    /**
     * @return array{type: 'review', quote: string, name: string, from: string, initial: string, rating: int}
     */
    public function toSliderItem(): array
    {
        $name = (string) $this->bilingual('name');
        $initial = mb_substr(trim($name) !== '' ? $name : '؟', 0, 1, 'UTF-8');

        return [
            'type' => 'review',
            'quote' => (string) $this->bilingual('quote'),
            'name' => $name,
            'from' => (string) $this->bilingual('from_city'),
            'initial' => $initial,
            'rating' => max(1, min(5, (int) $this->rating)),
        ];
    }

    /**
     * @return string|null
     */
    protected function bilingual(string $name)
    {
        $en = $this->getAttribute("{$name}_en");
        $ar = $this->getAttribute("{$name}_ar");
        if (app()->getLocale() === 'en' && filled($en)) {
            return $en;
        }
        if (filled($ar)) {
            return $ar;
        }

        return $en;
    }
}
