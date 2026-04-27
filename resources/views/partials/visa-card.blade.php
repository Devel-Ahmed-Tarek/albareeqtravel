@php
    $waText = $visa->t('wa_text') !== '' ? $visa->t('wa_text') : tr('site.pages.visas.default_wa', ['country' => $visa->t('country')]);
    $waUrl = site_whatsapp_url($waText);
@endphp

<article class="glass-panel-dark overflow-hidden rounded-2xl border border-sky-100">
    <div class="relative aspect-[16/9] overflow-hidden bg-slate-100">
        @if (filled($visa->resolvedImageUrl()))
            <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ $visa->resolvedImageUrl() }}');"></div>
        @endif
        @if (! empty($visa->discount_percent))
            <div class="absolute end-0 top-0 rounded-bl-2xl bg-rose-600 px-3 py-1 text-sm font-bold text-white">
                {{ $visa->discount_percent }}%
            </div>
        @endif
    </div>

    <div class="space-y-3 p-5">
        <div class="flex items-center justify-between gap-3">
            <h3 class="font-heading text-xl font-bold text-bareeq-navy">{{ $visa->t('country') }}</h3>
            @if ($visa->category)
                <span class="rounded-full bg-sky-100 px-2.5 py-1 text-xs font-semibold text-bareeq-blue">
                    {{ $visa->category->t('name') }}
                </span>
            @endif
        </div>

        @if ($visa->t('code') !== '')
            <p class="text-lg font-bold text-slate-700">{{ $visa->t('code') }}</p>
        @endif

        <div class="space-y-2 text-sm text-slate-600">
            @if ($visa->t('processing_time') !== '')
                <p>{{ tr('site.pages.visas.processing_time') }}: {{ $visa->t('processing_time') }}</p>
            @endif
            @if ($visa->t('validity') !== '')
                <p>{{ tr('site.pages.visas.validity') }}: {{ $visa->t('validity') }}</p>
            @endif
        </div>

        <div class="mt-2">
            @if (! is_null($visa->price_old))
                <span class="me-2 text-xl font-semibold text-rose-600 line-through">
                    {{ number_format((float) $visa->price_old, 0) }}
                </span>
            @endif
            <span class="text-sm text-slate-500">{{ tr('site.pages.visas.from') }}</span>
            <span class="ms-1 text-3xl font-extrabold text-bareeq-navy">
                {{ number_format((float) $visa->price_from, 0) }}
            </span>
            <span class="ms-1 text-sm font-semibold text-slate-500">{{ strtoupper((string) $visa->currency) }}</span>
        </div>

        <a
            href="{{ $waUrl }}"
            target="_blank"
            rel="noopener noreferrer"
            class="mt-2 inline-flex w-full items-center justify-center rounded-xl bg-gradient-to-l from-emerald-500 to-emerald-600 px-4 py-2.5 text-sm font-bold text-white transition hover:from-emerald-400 hover:to-emerald-500"
        >
            {{ tr('site.contact.wa') }}
        </a>
    </div>
</article>
