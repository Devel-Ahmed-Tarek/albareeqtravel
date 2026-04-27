<?php

namespace App\Models;

use App\Models\Concerns\HasBilingualFields;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class Visa extends Model
{
    use HasBilingualFields;

    protected $fillable = [
        'visa_category_id',
        'image',
        'image_path',
        'country_ar',
        'country_en',
        'code_ar',
        'code_en',
        'processing_time_ar',
        'processing_time_en',
        'validity_ar',
        'validity_en',
        'price_old',
        'price_from',
        'currency',
        'discount_percent',
        'sort_order',
        'is_active',
        'wa_text_ar',
        'wa_text_en',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'price_old' => 'decimal:2',
            'price_from' => 'decimal:2',
            'discount_percent' => 'integer',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(VisaCategory::class, 'visa_category_id');
    }

    public function scopeActiveOrdered(Builder $query): Builder
    {
        return $query->where('is_active', true)->orderBy('sort_order')->orderBy('id');
    }

    public function resolvedImageUrl(): string
    {
        if (filled($this->image_path)) {
            $path = ltrim((string) $this->image_path, '/');

            return asset('storage/'.$path);
        }

        return (string) $this->image;
    }

    protected static function booted(): void
    {
        static::saving(function (Visa $visa): void {
            if (filled($visa->image_path)) {
                $visa->setAttribute('image', '');
            }

            $hasPath = filled($visa->image_path);
            $hasUrl = trim((string) ($visa->getAttribute('image') ?? '')) !== '';
            if (! $hasPath && ! $hasUrl) {
                throw ValidationException::withMessages([
                    'image' => 'يرجى رفع صورة أو إدخال رابط الصورة.',
                ]);
            }

            if (! $visa->isDirty('image_path')) {
                return;
            }

            $old = (string) $visa->getOriginal('image_path');
            $new = (string) ($visa->image_path ?? '');
            if (filled($old) && $old !== $new) {
                Storage::disk('public')->delete($old);
            }
        });

        static::deleting(function (Visa $visa): void {
            if (filled($visa->image_path)) {
                Storage::disk('public')->delete($visa->image_path);
            }
        });
    }
}
