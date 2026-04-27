<?php

namespace App\Models;

use App\Models\Concerns\HasBilingualFields;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasBilingualFields;

    protected $fillable = [
        'image',
        'sort_order',
        'is_active',
        'title_ar',
        'title_en',
        'desc_ar',
        'desc_en',
        'badge_ar',
        'badge_en',
        'valid_note_ar',
        'valid_note_en',
        'wa_text_ar',
        'wa_text_en',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }
}
