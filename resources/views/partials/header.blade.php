@php
    $nav = [
        ['r' => 'home', 'is' => ['home']],
        ['r' => 'about', 'is' => ['about']],
        ['r' => 'programs', 'is' => ['programs']],
        ['r' => 'hotels', 'is' => ['hotels']],
        ['r' => 'destinations', 'is' => ['destinations']],
        ['r' => 'visas', 'is' => ['visas']],
        ['r' => 'blog', 'is' => ['blog', 'blog.show']],
        ['r' => 'news', 'is' => ['news', 'news.show']],
        ['r' => 'offers', 'is' => ['offers']],
    ];
@endphp
@php
    $logoUrl = site_settings()->resolvedLogoUrl(asset('images/albareeq-logo.png')) ?? asset('images/albareeq-logo.png');
@endphp

<header
    class="sticky top-0 z-40 border-b border-slate-200/90 bg-white/85 backdrop-blur-xl supports-[backdrop-filter]:bg-white/75"
>
    <div class="mx-auto max-w-7xl px-4 py-3 md:px-6">
        <div class="flex w-full flex-wrap items-center justify-between gap-y-2">
            <a
                href="{{ localized_route('home') }}"
                class="group order-1 flex min-w-0 max-w-[calc(100%-3.5rem)] items-center gap-0 md:max-w-none"
            >
                <img
                    src="{{ $logoUrl }}"
                    alt="{{ tr('site.site_name') }}"
                    class="h-9 w-auto max-w-[min(100%,12.5rem)] object-contain object-center transition [filter:drop-shadow(0_2px_12px_rgba(56,182,232,0.2))] group-hover:[filter:drop-shadow(0_2px_16px_rgba(251,191,36,0.25))] sm:h-10 sm:max-w-[14rem] md:h-11 md:max-w-[16rem]"
                    width="256"
                    height="64"
                    loading="eager"
                    decoding="async"
                />
            </a>

            <input type="checkbox" id="nav-toggle" class="nav-toggle order-2 peer sr-only md:hidden" />
            <label
                for="nav-toggle"
                class="order-2 flex cursor-pointer items-center justify-center rounded-xl border border-slate-200 p-2.5 text-slate-700 md:order-3 md:hidden"
                aria-label="Menu"
            >
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </label>

            <nav
                id="main-nav"
                class="order-4 hidden w-full min-w-0 flex-col border-t border-slate-200 bg-white py-2 md:order-2 md:flex md:w-auto md:flex-1 md:justify-end md:border-0 md:bg-transparent md:py-0"
                aria-label="Main"
            >
                <div
                    class="flex flex-col gap-0 md:ms-auto md:inline-flex md:flex-row md:items-center md:gap-1 md:py-0"
                >
                    @foreach ($nav as $item)
                        @php
                            $activePatterns = $item['is'] ?? [$item['r']];
                        @endphp
                        <a
                            href="{{ localized_route($item['r']) }}"
                            @class([
                                'block rounded-full px-3 py-2.5 text-sm font-medium transition md:inline-block md:py-1.5',
                                'bg-sky-100 text-bareeq-navy' => request()->routeIs(...$activePatterns),
                                'text-slate-600 hover:bg-slate-100 hover:text-bareeq-blue' => ! request()->routeIs(
                                    ...$activePatterns,
                                ),
                            ])
                        >
                            {{ tr('site.nav.' . $item['r']) }}
                        </a>
                    @endforeach
                    <a
                        href="{{ site_whatsapp_url() }}"
                        class="mt-1 block rounded-full bg-gradient-to-l from-emerald-500 to-emerald-600 px-4 py-2.5 text-center text-sm font-bold text-white shadow-md shadow-emerald-900/20 transition hover:from-emerald-400 hover:to-emerald-500 md:mt-0 md:ms-1 md:inline-block"
                        target="_blank"
                        rel="noopener noreferrer"
                    >
                        {{ tr('site.contact.wa') }}
                    </a>
                </div>
            </nav>
        </div>
    </div>
</header>
