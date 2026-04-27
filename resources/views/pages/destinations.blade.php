@extends('layouts.app')

@section('title', tr('site.pages.destinations.title'))

@section('meta_description', tr('site.pages.destinations.meta_description'))

@section('content')
    <div class="border-b border-slate-200/80 py-12 md:py-16">
        <div class="mx-auto max-w-3xl px-4 text-center md:px-6">
            <h1 class="font-heading text-3xl font-bold text-bareeq-navy md:text-4xl">
                {{ tr('site.pages.destinations.h1') }}
            </h1>
            <p class="mt-3 text-slate-600">{{ tr('site.pages.destinations.intro') }}</p>
        </div>
    </div>

    @include('partials.slider-bareeq', [
        'name' => 'destinations-page',
        'title' => tr('site.pages.destinations.grid_title'),
        'subtitle' => tr('site.pages.destinations.grid_subtitle'),
        'items' => $destinationShowcaseItems,
        'autoplay' => 5200,
        'theme' => 'destinations',
    ])

    <div class="border-b border-slate-200/80 py-10 md:py-14" data-reveal>
        <div class="mx-auto max-w-3xl px-4 text-center text-slate-600 md:px-6">
            <p>
                <a
                    href="https://wa.me/966532352749?text={{ rawurlencode(tr('site.pages.destinations.footer_wa')) }}"
                    class="font-semibold text-bareeq-blue transition hover:text-amber-800"
                >{{ tr('site.pages.destinations.footer_link') }}</a>
                {{ tr('site.pages.destinations.footer_rest') }}
            </p>
        </div>
    </div>
@endsection
