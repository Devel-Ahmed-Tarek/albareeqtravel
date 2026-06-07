@php
    $waText = $visa->t('wa_text') !== '' ? $visa->t('wa_text') : tr('site.pages.visas.default_wa', ['country' => $visa->t('country')]);
    $waUrl = site_whatsapp_url($waText);
    $hasProcessing = $visa->t('processing_time') !== '';
    $hasValidity = $visa->t('validity') !== '';
@endphp

<article
    class="glass-panel-dark group relative flex h-full flex-col overflow-hidden rounded-2xl border border-sky-200/60 transition duration-300 hover:-translate-y-1 hover:border-amber-300/45 hover:shadow-lg hover:shadow-sky-900/10"
>
    <div class="relative aspect-[5/3] overflow-hidden bg-gradient-to-br from-sky-100 via-slate-100 to-amber-50/80">
        @if (filled($visa->resolvedImageUrl()))
            <div
                class="absolute inset-0 bg-cover bg-center transition duration-500 group-hover:scale-105"
                style="background-image: url('{{ $visa->resolvedImageUrl() }}');"
            ></div>
        @endif
        <div
            class="absolute inset-0 bg-gradient-to-t from-bareeq-navy/75 via-bareeq-navy/20 to-transparent"
            aria-hidden="true"
        ></div>

        @if ($visa->category)
            <span
                class="absolute start-3 top-3 rounded-full border border-white/30 bg-white/90 px-2.5 py-1 text-xs font-semibold text-bareeq-blue backdrop-blur-sm"
            >
                {{ $visa->category->t('name') }}
            </span>
        @endif

        <div class="absolute inset-x-0 bottom-0 p-4">
            <h3 class="font-heading text-xl font-bold text-white drop-shadow-sm md:text-2xl">
                {{ $visa->t('country') }}
            </h3>
            @if ($visa->t('code') !== '')
                <p class="mt-0.5 text-sm font-medium text-sky-100/95">{{ $visa->t('code') }}</p>
            @endif
        </div>
    </div>

    <div class="flex flex-1 flex-col gap-4 p-5">
        @if ($hasProcessing || $hasValidity)
            <ul class="grid gap-2 sm:grid-cols-2" role="list">
                @if ($hasProcessing)
                    <li class="flex items-start gap-2.5 rounded-xl border border-sky-100 bg-sky-50/70 px-3 py-2.5">
                        <span
                            class="mt-0.5 flex h-7 w-7 shrink-0 items-center justify-center rounded-lg bg-sky-100 text-bareeq-blue"
                            aria-hidden="true"
                        >
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"
                                />
                            </svg>
                        </span>
                        <div class="min-w-0">
                            <p class="text-xs font-semibold text-slate-500">{{ tr('site.pages.visas.processing_time') }}</p>
                            <p class="text-sm font-medium text-slate-700">{{ $visa->t('processing_time') }}</p>
                        </div>
                    </li>
                @endif
                @if ($hasValidity)
                    <li class="flex items-start gap-2.5 rounded-xl border border-amber-100 bg-amber-50/60 px-3 py-2.5">
                        <span
                            class="mt-0.5 flex h-7 w-7 shrink-0 items-center justify-center rounded-lg bg-amber-100 text-amber-800"
                            aria-hidden="true"
                        >
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                                />
                            </svg>
                        </span>
                        <div class="min-w-0">
                            <p class="text-xs font-semibold text-slate-500">{{ tr('site.pages.visas.validity') }}</p>
                            <p class="text-sm font-medium text-slate-700">{{ $visa->t('validity') }}</p>
                        </div>
                    </li>
                @endif
            </ul>
        @endif

        <a
            href="{{ $waUrl }}"
            target="_blank"
            rel="noopener noreferrer"
            class="bareeq-cta-sheen mt-auto inline-flex w-full items-center justify-center gap-2 rounded-xl bg-gradient-to-l from-emerald-500 to-emerald-600 px-4 py-3 text-sm font-bold text-white shadow-md shadow-emerald-900/15 transition hover:from-emerald-400 hover:to-emerald-500"
        >
            <span aria-hidden="true">&#128172;</span>
            {{ tr('site.pages.visas.inquire_wa') }}
        </a>
    </div>
</article>
