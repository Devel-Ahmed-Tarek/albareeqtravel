<?php

namespace App\Models\Concerns;

trait HasBilingualFields
{
    public function t(string $name): string
    {
        $loc = app()->getLocale();
        $v = $this->getAttribute($name.'_'.$loc) ?? $this->getAttribute($name.'_ar');

        return (string) ($v ?? '');
    }
}
