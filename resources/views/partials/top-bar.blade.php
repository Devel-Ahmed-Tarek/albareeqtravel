@php
    $settings = site_settings();
    $phonePrimary = $settings->phone_primary ?: '+966 53 235 2749';
    $phoneSecondary = $settings->phone_secondary;
    $socialLinks = [
        ['url' => $settings->social_linkedin, 'label' => 'LinkedIn', 'icon' => 'linkedin'],
        ['url' => $settings->social_x, 'label' => 'X', 'icon' => 'x'],
        ['url' => $settings->social_facebook, 'label' => 'Facebook', 'icon' => 'facebook'],
        ['url' => $settings->social_instagram, 'label' => 'Instagram', 'icon' => 'instagram'],
        ['url' => $settings->social_tiktok, 'label' => 'TikTok', 'icon' => 'tiktok'],
        ['url' => $settings->social_youtube, 'label' => 'YouTube', 'icon' => 'youtube'],
    ];
@endphp
<div class="border-b border-slate-200/80 bg-sky-50/90 backdrop-blur-md">
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
            <div class="flex items-center gap-1 text-slate-500" aria-label="التواصل الاجتماعي">
                @foreach ($socialLinks as $social)
                    @continue(! filled($social['url']))
                    @if ($social['icon'] === 'linkedin')
                        <a href="{{ $social['url'] }}" target="_blank" rel="noopener noreferrer" class="rounded-lg p-2 transition hover:bg-sky-100 hover:text-bareeq-blue" aria-label="{{ $social['label'] }}"
                    ><svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"
                        ><path
                            d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"
                        /></svg
                ></a>
                    @elseif ($social['icon'] === 'x')
                        <a href="{{ $social['url'] }}" target="_blank" rel="noopener noreferrer" class="rounded-lg p-2 transition hover:bg-sky-100 hover:text-bareeq-blue" aria-label="{{ $social['label'] }}"
                    ><svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"
                        ><path
                            d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"
                        /></svg
                ></a>
                    @elseif ($social['icon'] === 'facebook')
                        <a href="{{ $social['url'] }}" target="_blank" rel="noopener noreferrer" class="rounded-lg p-2 transition hover:bg-sky-100 hover:text-bareeq-blue" aria-label="{{ $social['label'] }}"
                    ><svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"
                        ><path
                            d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"
                        /></svg
                ></a>
                    @elseif ($social['icon'] === 'instagram')
                        <a href="{{ $social['url'] }}" target="_blank" rel="noopener noreferrer" class="rounded-lg p-2 transition hover:bg-sky-100 hover:text-bareeq-blue" aria-label="{{ $social['label'] }}">IG</a>
                    @elseif ($social['icon'] === 'tiktok')
                        <a href="{{ $social['url'] }}" target="_blank" rel="noopener noreferrer" class="rounded-lg p-2 transition hover:bg-sky-100 hover:text-bareeq-blue" aria-label="{{ $social['label'] }}">TT</a>
                    @elseif ($social['icon'] === 'youtube')
                        <a href="{{ $social['url'] }}" target="_blank" rel="noopener noreferrer" class="rounded-lg p-2 transition hover:bg-sky-100 hover:text-bareeq-blue" aria-label="{{ $social['label'] }}">YT</a>
                    @endif
                @endforeach
            </div>
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
