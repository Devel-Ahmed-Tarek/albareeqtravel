<footer class="bareeq-footer mt-auto py-10">
    @php
        $settings = site_settings();
        $logoUrl = $settings->resolvedLogoUrl(asset('images/albareeq-logo.png')) ?? asset('images/albareeq-logo.png');
        $siteName = site_setting_localized('site_name', 'AlBareeq Travel') ?? 'AlBareeq Travel';
    @endphp
    <div
        class="mx-auto flex max-w-6xl flex-col items-center justify-between gap-6 px-4 text-center text-sm text-slate-600 md:flex-row md:text-start"
    >
        <div class="flex flex-col items-center gap-3 sm:items-start">
            <img
                src="{{ $logoUrl }}"
                alt=""
                class="h-8 w-auto max-w-[11rem] object-contain opacity-90"
                width="200"
                height="48"
                loading="lazy"
                decoding="async"
                aria-hidden="true"
            />
            <div>
                <p class="font-bold text-bareeq-navy">{{ $siteName }}</p>
                <p class="mt-1">{{ tr('site.footer.tagline') }}</p>
                @include('partials.social-links', [
                    'wrapperClass' => 'mt-4 flex items-center justify-center gap-1.5 sm:justify-start',
                    'linkClass' => 'rounded-lg border border-slate-200/80 bg-white/70 p-2.5 text-slate-500 shadow-sm transition hover:border-sky-200 hover:bg-sky-50 hover:text-bareeq-blue',
                    'iconClass' => 'h-4 w-4',
                ])
            </div>
        </div>
        <nav class="flex max-w-sm flex-wrap justify-center gap-x-4 gap-y-2 md:justify-end" aria-label="Footer">
            <a href="{{ localized_route('about') }}" class="hover:text-amber-700">{{ tr('site.nav.about') }}</a>
            <a href="{{ localized_route('programs') }}" class="hover:text-amber-700">{{ tr('site.nav.programs') }}</a>
            {{-- <a href="{{ localized_route('blog') }}" class="hover:text-amber-700">{{ tr('site.nav.blog') }}</a> --}}
            <a href="{{ localized_route('visas') }}" class="hover:text-amber-700">{{ tr('site.nav.visas') }}</a>
            {{-- <a href="{{ localized_route('news') }}" class="hover:text-amber-700">{{ tr('site.nav.news') }}</a> --}}
            <a href="{{ localized_route('offers') }}" class="hover:text-amber-700">{{ tr('site.nav.offers') }}</a>
            <a href="{{ site_whatsapp_url() }}" class="hover:text-amber-700" target="_blank" rel="noopener noreferrer">{{ tr('site.contact.wa') }}</a>
        </nav>
        <div class="space-y-1 text-center md:text-end">
            <p class="text-balance">© {{ date('Y') }} {{ $siteName }}.</p>
            <p class="text-xs text-slate-500">
                {{ tr('site.footer.developed_by') }}
                <a
                    href="https://codiing-solutions.com/"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="font-semibold text-bareeq-blue hover:text-amber-700"
                >
                    Coding Solutions
                </a>
            </p>
        </div>
    </div>
</footer>
