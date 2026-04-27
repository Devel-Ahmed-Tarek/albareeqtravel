<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class HotelShowcaseSlide extends Model
{
    protected $fillable = [
        'sort_order',
        'is_active',
        'image',
        'image_path',
        'title_ar',
        'title_en',
        'desc_ar',
        'desc_en',
        'badge_ar',
        'badge_en',
        'link_route',
        'link_href_ar',
        'link_href_en',
        'wa_prefill_ar',
        'wa_prefill_en',
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

    public function resolvedImageUrl(): string
    {
        if (filled($this->image_path)) {
            return asset('storage/'.ltrim((string) $this->image_path, '/'));
        }

        return (string) $this->image;
    }

    /**
     * @return array{image: string, title: string, desc: string, badge?: string, url: string}
     */
    public function toSliderItem(): array
    {
        $item = [
            'image' => $this->resolvedImageUrl(),
            'title' => (string) $this->bilingual('title'),
            'desc' => (string) $this->bilingual('desc'),
            'url' => $this->resolvedUrl(),
        ];
        $badge = (string) $this->bilingual('badge');
        if (filled($badge)) {
            $item['badge'] = $badge;
        }

        return $item;
    }

    public function resolvedUrl(): string
    {
        if (filled($this->link_route) && $this->namedRouteResolves($this->link_route)) {
            return localized_route($this->link_route);
        }
        $h = (string) $this->bilingual('link_href');
        if (trim($h) !== '') {
            return $h;
        }
        $wa = trim((string) $this->bilingual('wa_prefill'));
        if ($wa !== '') {
            return 'https://wa.me/966532352749?text='.rawurlencode($wa);
        }

        return 'https://wa.me/966532352749?text='.rawurlencode((string) tr('site.pages.hotels.cta_wa'));
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

    protected function namedRouteResolves(string $name): bool
    {
        if (app()->getLocale() === 'en' && Route::has('en.'.$name)) {
            return true;
        }

        return Route::has($name);
    }

    protected static function booted(): void
    {
        static::saving(function (HotelShowcaseSlide $m): void {
            if (filled($m->image_path)) {
                $m->setAttribute('image', '');
            }
            $hasPath = filled($m->image_path);
            $hasUrl = trim((string) ($m->getAttribute('image') ?? '')) !== '';
            if (! $hasPath && ! $hasUrl) {
                throw ValidationException::withMessages([
                    'image' => 'يرجى رفع صورة أو وضع رابط صورة.',
                ]);
            }
            if (! $m->isDirty('image_path')) {
                return;
            }
            $old = (string) $m->getOriginal('image_path');
            $new = (string) ($m->image_path ?? '');
            if (filled($old) && $old !== $new) {
                Storage::disk('public')->delete($old);
            }
        });
        static::deleting(function (HotelShowcaseSlide $m): void {
            if (filled($m->image_path)) {
                Storage::disk('public')->delete($m->image_path);
            }
        });
    }
}
