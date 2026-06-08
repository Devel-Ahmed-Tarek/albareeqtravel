@php
    $settings = site_settings();
    $phonePrimary = $settings->phone_primary ?: '+966 53 235 2749';
    $phoneSecondary = $settings->phone_secondary;
@endphp
<div class="bareeq-top-bar">
    <div class="mx-auto flex max-w-7xl flex-wrap items-center justify-between gap-3 px-4 py-2 text-sm text-slate-600 md:px-6">
        <div class="flex flex-wrap items-center gap-4">
            <a
                href="tel:{{ preg_replace('/\s+/', '', $phonePrimary) }}"
                class="inline-flex items-center gap-2 font-medium text-bareeq-blue transition hover:text-amber-700"
            >
                <span class="text-amber-300/80" aria-hidden="true">&#128222;</span>
                {{ $phonePrimary }}
            </a>
            @if (filled($phoneSecondary))
                <a
                    href="tel:{{ preg_replace('/\s+/', '', $phoneSecondary) }}"
                    class="inline-flex items-center gap-2 font-medium text-bareeq-blue transition hover:text-amber-700"
                >
                    <span class="text-amber-300/80" aria-hidden="true">&#128222;</span>
                    {{ $phoneSecondary }}
                </a>
            @endif
            <span class="hidden h-4 w-px bg-slate-300/80 sm:block" aria-hidden="true"></span>
            @include('partials.social-links')
        </div>
        <div class="flex flex-wrap items-center justify-end gap-3 text-xs text-slate-600">
            @if (app()->getLocale() === 'ar')
                <a
                    href="{{ alternate_locale_url('en') }}"
                    class="rounded-lg border border-slate-300 px-2.5 py-1 font-semibold text-bareeq-blue transition hover:border-amber-500/50 hover:text-amber-800"
                    hreflang="en"
                >
                    English
                </a>
            @else
                <a
                    href="{{ alternate_locale_url('ar') }}"
                    class="rounded-lg border border-slate-300 px-2.5 py-1 font-semibold text-bareeq-blue transition hover:border-amber-500/50 hover:text-amber-800"
                    hreflang="ar"
                >
                    {{ tr('site.lang_switch') }}
                </a>
            @endif
            <div class="flex items-center gap-1">
                <span
                    class="me-1 inline-block h-1.5 w-1.5 rounded-full bg-emerald-400 shadow-[0_0_8px_#34d399]"
                    aria-hidden="true"
                ></span>
                24/7
            </div>
        </div>
    </div>
</div>
