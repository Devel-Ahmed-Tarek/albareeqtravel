<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class HeroSlide extends Model
{
    /**
     * @return array<string, string>
     */
    public static function internalRouteOptions(): array
    {
        return [
            '' => '— بدون —',
            'home' => 'الرئيسية',
            'about' => 'من نحن',
            'programs' => 'البرامج',
            'hotels' => 'الفنادق',
            'destinations' => 'الوجهات',
            'contact' => 'اتصل بنا',
            'blog' => 'المدونة',
            'offers' => 'العروض',
        ];
    }

    /**
     * @return array<string, string>
     */
    public static function internalRouteOptionsForForm(): array
    {
        $o = self::internalRouteOptions();
        unset($o['']);

        return $o;
    }

    protected $fillable = [
        'sort_order',
        'is_active',
        'image',
        'image_path',
        'image_label_ar',
        'image_label_en',
        'kicker_ar',
        'kicker_en',
        'title_ar',
        'title_en',
        'lead_ar',
        'lead_en',
        'primary_route',
        'primary_href_ar',
        'primary_href_en',
        'primary_label_ar',
        'primary_label_en',
        'secondary_route',
        'secondary_href_ar',
        'secondary_href_en',
        'secondary_label_ar',
        'secondary_label_en',
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
            $path = ltrim((string) $this->image_path, '/');

            return asset('storage/'.$path);
        }

        return (string) $this->image;
    }

    public function toSliderRow(): array
    {
        $primaryHref = $this->resolvePrimaryHref();
        $secondaryHref = $this->resolveSecondaryHref();

        return [
            'image' => $this->resolvedImageUrl(),
            'image_label' => (string) $this->bilingual('image_label'),
            'kicker' => (string) $this->bilingual('kicker'),
            'title' => (string) $this->bilingual('title'),
            'lead' => (string) $this->bilingual('lead'),
            'primary_href' => $primaryHref,
            'primary_label' => (string) $this->bilingual('primary_label'),
            'secondary_href' => $secondaryHref,
            'secondary_label' => (string) $this->bilingual('secondary_label'),
        ];
    }

    public function resolvePrimaryHref(): ?string
    {
        if (filled($this->primary_route) && $this->namedRouteResolves($this->primary_route)) {
            return localized_route($this->primary_route);
        }

        $url = (string) $this->bilingual('primary_href');

        return $url !== '' ? $url : null;
    }

    public function resolveSecondaryHref(): ?string
    {
        if (filled($this->secondary_route) && $this->namedRouteResolves($this->secondary_route)) {
            return localized_route($this->secondary_route);
        }

        $url = (string) $this->bilingual('secondary_href');

        return $url !== '' ? $url : null;
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
        static::saving(function (HeroSlide $h): void {
            if (filled($h->image_path)) {
                $h->setAttribute('image', '');
            }

            $hasPath = filled($h->image_path);
            $hasUrl = trim((string) ($h->getAttribute('image') ?? '')) !== '';
            if (! $hasPath && ! $hasUrl) {
                throw ValidationException::withMessages([
                    'image' => 'يرجى رفع صورة من الجهاز أو إدخال رابط لصورة الخلفية.',
                ]);
            }

            if (! $h->isDirty('image_path')) {
                return;
            }

            $old = (string) $h->getOriginal('image_path');
            $new = (string) ($h->image_path ?? '');
            if (filled($old) && $old !== $new) {
                Storage::disk('public')->delete($old);
            }
        });

        static::deleting(function (HeroSlide $h): void {
            if (filled($h->image_path)) {
                Storage::disk('public')->delete($h->image_path);
            }
        });
    }
}
