<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = [
        'logo_path',
        'favicon_path',
        'site_name_ar',
        'site_name_en',
        'default_meta_ar',
        'default_meta_en',
        'phone_primary',
        'phone_secondary',
        'whatsapp_number',
        'contact_email',
        'social_facebook',
        'social_instagram',
        'social_snapchat',
        'social_x',
        'social_linkedin',
        'social_tiktok',
        'social_youtube',
    ];

    public static function singleton(): self
    {
        /** @var self $record */
        $record = static::query()->firstOrCreate(
            ['id' => 1],
            [
                'whatsapp_number' => '966532352749',
                'phone_primary' => '+966 53 235 2749',
            ],
        );

        return $record;
    }

    public function localized(string $base, ?string $fallback = null): ?string
    {
        $ar = (string) ($this->getAttribute($base.'_ar') ?? '');
        $en = (string) ($this->getAttribute($base.'_en') ?? '');
        if (app()->getLocale() === 'en' && trim($en) !== '') {
            return $en;
        }

        if (trim($ar) !== '') {
            return $ar;
        }

        if (trim($en) !== '') {
            return $en;
        }

        return $fallback;
    }

    public function resolvedLogoUrl(?string $fallback = null): ?string
    {
        if (filled($this->logo_path)) {
            return asset('storage/'.ltrim((string) $this->logo_path, '/'));
        }

        return $fallback;
    }

    public function resolvedFaviconUrl(?string $fallback = null): ?string
    {
        if (filled($this->favicon_path)) {
            return asset('storage/'.ltrim((string) $this->favicon_path, '/'));
        }

        return $fallback;
    }

    public function whatsappUrl(?string $message = null): string
    {
        $digits = preg_replace('/\D+/', '', (string) $this->whatsapp_number) ?: '966532352749';
        $text = trim((string) $message);

        if ($text === '') {
            return 'https://wa.me/'.$digits;
        }

        return 'https://wa.me/'.$digits.'?text='.rawurlencode($text);
    }
}
