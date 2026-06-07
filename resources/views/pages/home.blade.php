@extends('layouts.app')

@section('title', tr('site.home.page_title'))

@section('content')
    @include('partials.hero-slider', ['slides' => $heroSlides, 'autoplay' => 7000])

    <section
        class="bareeq-section py-16 md:py-24"
        aria-labelledby="home-about"
        data-reveal
    >
        <div class="mx-auto max-w-6xl px-4 md:px-6">
            <div class="grid items-start gap-10 lg:grid-cols-2 lg:gap-14">
                <div>
                    <h2
                        id="home-about"
                        class="mb-4 font-heading text-2xl font-bold text-bareeq-navy md:text-3xl"
                    >
                        {{ tr('site.home.about_title') }}
                    </h2>
                    <p class="text-lg leading-relaxed text-slate-700">
                        {!! tr('site.home.about_p1') !!}
                    </p>
                    <p class="mt-4 leading-relaxed text-slate-600">
                        {!! tr('site.home.about_p2') !!}
                    </p>
                    <a
                        href="{{ localized_route('about') }}"
                        class="mt-6 inline-flex items-center gap-2 text-sm font-bold text-amber-800 transition hover:text-amber-700"
                    >
                        {{ tr('site.home.about_cta') }}
                        <span aria-hidden="true">→</span>
                    </a>
                </div>
                <div class="grid gap-4 sm:grid-cols-2">
                    <div
                        class="glass-panel-dark rounded-2xl border border-amber-200/50 p-6 sm:col-span-2 lg:col-span-1"
                    >
                        <p class="text-xs font-semibold uppercase tracking-wider text-amber-800/90">
                            {{ tr('site.home.about_trust_label') }}
                        </p>
                        <p class="mt-2 text-sm leading-relaxed text-slate-700">
                            {!! tr('site.home.about_trust_body', ['iata' => tr('site.home.about_iata_title')]) !!}
                        </p>
                    </div>
                    <ul class="space-y-3 sm:col-span-2 lg:col-span-1" role="list">
                        <li
                            class="flex gap-3 rounded-2xl border border-slate-200/90 bg-sky-50/80 p-4 text-slate-700"
                        >
                            <span
                                class="mt-0.5 flex h-8 w-8 shrink-0 items-center justify-center rounded-xl bg-sky-100 text-bareeq-blue"
                                aria-hidden="true"
                            >✦</span>
                            <span class="text-sm">{{ tr('site.home.about_bullet1') }}</span>
                        </li>
                        <li
                            class="flex gap-3 rounded-2xl border border-slate-200/90 bg-amber-50/80 p-4 text-slate-700"
                        >
                            <span
                                class="mt-0.5 flex h-8 w-8 shrink-0 items-center justify-center rounded-xl bg-amber-100 text-amber-800"
                                aria-hidden="true"
                            >◎</span>
                            <span class="text-sm">{{ tr('site.home.about_bullet2') }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section
        class="bareeq-section bareeq-section--sky py-16 md:py-24"
        aria-labelledby="home-branches"
        data-reveal
    >
        <div class="mx-auto max-w-6xl px-4 md:px-6">
            <div class="mb-10 flex flex-col items-center justify-between gap-4 text-center sm:flex-row sm:text-start">
                <div>
                    <h2 id="home-branches" class="font-heading text-2xl font-bold text-bareeq-navy md:text-3xl">
                        {{ tr('site.contact.branches') }}
                    </h2>
                    <p class="mt-2 max-w-2xl text-slate-600">
                        {{ tr('site.home.branches_subtitle') }}
                    </p>
                </div>
                <a
                    href="{{ site_whatsapp_url() }}"
                    class="shrink-0 rounded-full border border-sky-300 px-5 py-2.5 text-sm font-semibold text-bareeq-blue transition hover:border-amber-400 hover:text-amber-800"
                    target="_blank"
                    rel="noopener noreferrer"
                >
                    {{ tr('site.contact.wa') }}
                </a>
            </div>
            <div
                class="grid grid-cols-1 gap-5 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3"
            >
                @forelse ($branches as $branch)
                    <div class="glass-panel-dark flex flex-col rounded-2xl p-6">
                        <h3 class="mb-1 font-bold text-bareeq-navy">{{ $branch->titleForLocale() }}</h3>
                        @if (filled($branch->addressForLocale()))
                            <p class="text-sm text-slate-600">
                                {{ $branch->addressForLocale() }}
                            </p>
                        @endif
                        <a
                            href="{{ $branch->phoneTelHref() }}"
                            class="mt-4 inline-flex w-fit text-sm font-semibold text-bareeq-blue transition hover:text-amber-800"
                        >
                            {{ $branch->phone }}
                        </a>
                    </div>
                @empty
                    <p class="text-sm text-slate-500 sm:col-span-2 lg:col-span-3">
                        {{ app()->getLocale() === 'en' ? 'No branch listings yet.' : 'لا توجد فروع مضافة حالياً.' }}
                    </p>
                @endforelse
            </div>
        </div>
    </section>

    <section
        class="bareeq-section py-16 md:py-24"
        aria-label="{{ tr('site.home.discover_aria') }}"
        data-reveal
    >
        <div class="mx-auto max-w-6xl px-4 md:px-6">
            <h2 class="mb-8 text-center font-heading text-2xl font-bold text-bareeq-navy md:text-3xl">
                {{ tr('site.home.discover_title') }}
            </h2>
            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                <a
                    href="{{ localized_route('programs') }}"
                    class="glass-panel-dark group overflow-hidden rounded-2xl p-6 transition will-change-transform hover:-translate-y-1 hover:border-amber-400/25"
                >
                    <h3 class="mb-2 font-bold text-bareeq-navy">{{ tr('site.nav.programs') }}</h3>
                    <p class="text-sm text-slate-600">{{ tr('site.home.discover_lead_programs') }}</p>
                </a>
                <a
                    href="{{ localized_route('hotels') }}"
                    class="glass-panel-dark group overflow-hidden rounded-2xl p-6 transition will-change-transform hover:-translate-y-1 hover:border-amber-400/25"
                >
                    <h3 class="mb-2 font-bold text-bareeq-navy">{{ tr('site.nav.hotels') }}</h3>
                    <p class="text-sm text-slate-600">{{ tr('site.home.discover_lead_hotels') }}</p>
                </a>
                <a
                    href="{{ localized_route('destinations') }}"
                    class="glass-panel-dark group overflow-hidden rounded-2xl p-6 transition will-change-transform hover:-translate-y-1 hover:border-amber-400/25"
                >
                    <h3 class="mb-2 font-bold text-bareeq-navy">{{ tr('site.nav.destinations') }}</h3>
                    <p class="text-sm text-slate-600">{{ tr('site.home.discover_lead_destinations') }}</p>
                </a>
                {{--
                <a
                    href="{{ localized_route('blog') }}"
                    class="glass-panel-dark group overflow-hidden rounded-2xl p-6 transition will-change-transform hover:-translate-y-1 hover:border-amber-400/25"
                >
                    <h3 class="mb-2 font-bold text-bareeq-navy">{{ tr('site.nav.blog') }}</h3>
                    <p class="text-sm text-slate-600">{{ tr('site.home.discover_lead_blog') }}</p>
                </a>
                <a
                    href="{{ localized_route('news') }}"
                    class="glass-panel-dark group overflow-hidden rounded-2xl p-6 transition will-change-transform hover:-translate-y-1 hover:border-amber-400/25"
                >
                    <h3 class="mb-2 font-bold text-bareeq-navy">{{ tr('site.nav.news') }}</h3>
                    <p class="text-sm text-slate-600">{{ tr('site.home.discover_lead_news') }}</p>
                </a>
                --}}
                <a
                    href="{{ localized_route('offers') }}"
                    class="glass-panel-dark group overflow-hidden rounded-2xl p-6 transition will-change-transform hover:-translate-y-1 hover:border-amber-400/25"
                >
                    <h3 class="mb-2 font-bold text-bareeq-navy">{{ tr('site.nav.offers') }}</h3>
                    <p class="text-sm text-slate-600">{{ tr('site.home.discover_lead_offers') }}</p>
                </a>
                <a
                    href="{{ localized_route('visas') }}"
                    class="glass-panel-dark group overflow-hidden rounded-2xl p-6 transition will-change-transform hover:-translate-y-1 hover:border-amber-400/25"
                >
                    <h3 class="mb-2 font-bold text-bareeq-navy">{{ tr('site.nav.visas') }}</h3>
                    <p class="text-sm text-slate-600">{{ tr('site.home.discover_lead_visas') }}</p>
                </a>
            </div>
        </div>
    </section>

    <section class="bareeq-section bareeq-section--warm py-16 md:py-24" data-reveal aria-labelledby="home-visas">
        <div class="mx-auto max-w-6xl px-4 md:px-6">
            <div class="mb-8 flex flex-wrap items-center justify-between gap-4">
                <h2 id="home-visas" class="font-heading text-2xl font-bold text-bareeq-navy md:text-3xl">
                    {!! tr('site.home.visas_title') !!}
                </h2>
                <a
                    href="{{ localized_route('visas') }}"
                    class="inline-flex items-center rounded-full border border-sky-300 px-4 py-2 text-sm font-semibold text-bareeq-blue transition hover:border-amber-400 hover:text-amber-800"
                >
                    {{ tr('site.home.visas_cta') }}
                </a>
            </div>

            @if ($homeVisaItems->isEmpty())
                <p class="text-sm text-slate-500">{{ tr('site.pages.visas.empty') }}</p>
            @else
                <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($homeVisaItems as $visa)
                        @include('partials.visa-card', ['visa' => $visa])
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    @include('partials.slider-bareeq', [
        'name' => 'destinations',
        'title' => tr('site.home.map_destinations_title'),
        'subtitle' => tr('site.home.map_destinations_subtitle'),
        'items' => $mapDestinationItems,
        'autoplay' => 5200,
        'theme' => 'default',
        'variant' => 'sky',
    ])

    @include('partials.slider-bareeq', [
        'name' => 'trips',
        'title' => tr('site.home.trips_showcase_title'),
        'subtitle' => tr('site.home.trips_showcase_subtitle'),
        'items' => $tripShowcaseItems,
        'theme' => 'trips',
        'layout' => 'grid',
        'variant' => 'soft',
    ])

    @include('partials.slider-bareeq', [
        'name' => 'reviews',
        'title' => tr('site.home.reviews_title'),
        'subtitle' => tr('site.home.reviews_subtitle'),
        'items' => $reviewItems,
        'theme' => 'reviews',
        'layout' => 'grid',
        'variant' => 'warm',
    ])

    @include('partials.section-contact-cta')
@endsection

