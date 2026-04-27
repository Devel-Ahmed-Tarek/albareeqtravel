@extends('layouts.app')

@section('title', tr('site.pages.hotels.title'))

@section('meta_description', tr('site.pages.hotels.meta_description'))

@section('content')
    <div class="border-b border-slate-200/80 py-12 md:py-16">
        <div class="mx-auto max-w-3xl px-4 text-center md:px-6">
            <h1 class="font-heading text-3xl font-bold text-bareeq-navy md:text-4xl">
                {{ tr('site.pages.hotels.h1') }}
            </h1>
            <p class="mt-3 text-slate-600">{{ tr('site.pages.hotels.intro') }}</p>
        </div>
    </div>

    @include('partials.slider-bareeq', [
        'name' => 'hotels-page',
        'title' => tr('site.pages.hotels.grid_title'),
        'subtitle' => tr('site.pages.hotels.grid_subtitle'),
        'items' => $hotelShowcaseItems,
        'theme' => 'hotels',
        'layout' => 'grid',
    ])

    <section
        class="border-t border-slate-200/80 bg-gradient-to-b from-transparent to-sky-50/60 py-16 md:py-24"
        aria-labelledby="hotel-cta"
    >
        <div class="mx-auto max-w-2xl px-4 text-center md:px-6">
            <h2 id="hotel-cta" class="font-heading text-2xl font-bold text-bareeq-navy">
                {{ tr('site.pages.hotels.cta_h2') }}
            </h2>
            <p class="mt-2 text-slate-600">{{ tr('site.pages.hotels.cta_lead') }}</p>
            <a
                href="https://wa.me/966532352749?text={{ rawurlencode(tr('site.pages.hotels.cta_wa')) }}"
                class="mt-6 inline-flex items-center justify-center rounded-2xl border border-amber-500/50 bg-amber-50 px-8 py-3 font-bold text-amber-900 transition hover:bg-amber-100"
            >
                {{ tr('site.pages.hotels.cta_button') }}
            </a>
        </div>
    </section>
@endsection
