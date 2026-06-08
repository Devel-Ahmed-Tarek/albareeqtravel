<?php

use App\Models\SiteSetting;
use App\Models\SiteTranslation;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Route;

if (! function_exists('localized_route')) {
    /**
     * ينتج route بالاسم الحالي حسب لغة الواجهة (ar: بدون بادئة en.، en: en.*)
     */
    function localized_route(string $name, mixed $parameters = [], bool $absolute = true): string
    {
        if (app()->getLocale() === 'en' && ! str_starts_with($name, 'en.')) {
            if (Route::has('en.'.$name)) {
                $name = 'en.'.$name;
            }
        }

        return route($name, $parameters, $absolute);
    }
}

if (! function_exists('alternate_locale_url')) {
    /**
     * رابط نفس المسار باللغة الأخرى (للمبدّل في الهيدر)
     */
    function alternate_locale_url(string $otherLocale): string
    {
        if (app()->getLocale() === $otherLocale) {
            return url()->current();
        }
        $p = request()->path();
        if ($otherLocale === 'en') {
            if (str_starts_with($p, 'en/') || $p === 'en') {
                return url($p);
            }
            $suffix = ltrim($p, '/');

            return $suffix ? url('en/'.$suffix) : url('/en');
        }
        if ($otherLocale === 'ar') {
            if (str_starts_with($p, 'en/')) {
                $rest = ltrim(substr($p, 3), '/');

                return $rest === '' ? url('/') : url('/'.$rest);
            }
            if ($p === '' || $p === '/') {
                return url('/');
            }

            return url('/'.ltrim($p, '/'));
        }

        return url()->current();
    }
}

if (! function_exists('site_settings')) {
    function site_settings(): SiteSetting
    {
        static $cached = null;
        if ($cached instanceof SiteSetting) {
            return $cached;
        }

        return $cached = SiteSetting::singleton();
    }
}

if (! function_exists('site_setting_localized')) {
    function site_setting_localized(string $base, ?string $fallback = null): ?string
    {
        return site_settings()->localized($base, $fallback);
    }
}

if (! function_exists('site_whatsapp_url')) {
    function site_whatsapp_url(?string $message = null): string
    {
        return site_settings()->whatsappUrl($message);
    }
}

if (! function_exists('site_social_links')) {
    /**
     * @return list<array{url: string, label: string, icon: string}>
     */
    function site_social_links(): array
    {
        $settings = site_settings();

        return array_values(array_filter([
            ['url' => (string) $settings->social_facebook, 'label' => 'Facebook', 'icon' => 'facebook'],
            ['url' => (string) $settings->social_instagram, 'label' => 'Instagram', 'icon' => 'instagram'],
            ['url' => (string) $settings->social_snapchat, 'label' => 'Snapchat', 'icon' => 'snapchat'],
            ['url' => (string) $settings->social_x, 'label' => 'X', 'icon' => 'x'],
            ['url' => (string) $settings->social_linkedin, 'label' => 'LinkedIn', 'icon' => 'linkedin'],
            ['url' => (string) $settings->social_tiktok, 'label' => 'TikTok', 'icon' => 'tiktok'],
            ['url' => (string) $settings->social_youtube, 'label' => 'YouTube', 'icon' => 'youtube'],
        ], static fn (array $item): bool => filled($item['url'])));
    }
}

if (! function_exists('tr')) {
    /**
     * DB-overridable translation with file fallback.
     */
    function tr(string $key, array $replace = [], ?string $locale = null): string
    {
        $locale ??= app()->getLocale();
        static $loaded = false;
        static $map = ['ar' => [], 'en' => []];

        if (! $loaded) {
            $loaded = true;
            try {
                if (Schema::hasTable('site_translations')) {
                    $rows = SiteTranslation::query()
                        ->active()
                        ->get(['key', 'value_ar', 'value_en']);
                    foreach ($rows as $row) {
                        $k = (string) $row->key;
                        $map['ar'][$k] = (string) ($row->value_ar ?? '');
                        $map['en'][$k] = (string) ($row->value_en ?? '');
                    }
                }
            } catch (\Throwable) {
                // Keep fallback to lang files during bootstrap/migrations.
            }
        }

        $line = $map[$locale][$key] ?? '';
        if (trim($line) === '') {
            $line = $map[$locale === 'en' ? 'ar' : 'en'][$key] ?? '';
        }
        if (trim($line) === '') {
            $line = __($key, $replace, $locale);
        } elseif ($replace !== []) {
            foreach ($replace as $rk => $rv) {
                $line = str_replace(':'.$rk, (string) $rv, $line);
            }
        }

        return (string) $line;
    }
}
