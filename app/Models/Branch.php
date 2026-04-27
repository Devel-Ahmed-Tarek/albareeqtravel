<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $fillable = [
        'sort_order',
        'is_active',
        'title_ar',
        'title_en',
        'address_ar',
        'address_en',
        'phone',
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

    public function titleForLocale(): string
    {
        if (app()->getLocale() === 'en' && filled($this->title_en)) {
            return (string) $this->title_en;
        }

        return (string) $this->title_ar;
    }

    public function addressForLocale(): string
    {
        if (app()->getLocale() === 'en' && filled($this->address_en)) {
            return (string) $this->address_en;
        }

        return (string) ($this->address_ar ?? '');
    }

    public function phoneTelHref(): string
    {
        $s = (string) $this->phone;
        $digits = '';
        for ($i = 0, $len = strlen($s); $i < $len; $i++) {
            if (ctype_digit($s[$i])) {
                $digits .= $s[$i];
            }
        }
        if ($digits === '') {
            return 'tel:';
        }
        if (str_contains($s, '+')) {
            return 'tel:+'.$digits;
        }
        if (str_starts_with($digits, '0') && strlen($digits) === 10) {
            $digits = '966'.substr($digits, 1);
        } elseif (strlen($digits) === 9 && str_starts_with($digits, '5')) {
            $digits = '966'.$digits;
        }

        return 'tel:+'.$digits;
    }
}
