@extends('layouts.app')

@section('title', tr('site.pages.programs.title'))

@section('meta_description', tr('site.pages.programs.meta_description'))

@section('content')
    <div class="border-b border-slate-200/80 py-12 md:py-16">
        <div class="mx-auto max-w-3xl px-4 text-center md:px-6">
            <h1 class="font-heading text-3xl font-bold text-bareeq-navy md:text-4xl">
                {{ tr('site.pages.programs.h1') }}
            </h1>
            <p class="mt-3 text-slate-600">{{ tr('site.pages.programs.intro') }}</p>
        </div>
    </div>

    <section class="py-12 md:py-20" aria-labelledby="services">
        <div class="mx-auto max-w-6xl px-4 md:px-6">
            <h2 id="services" class="mb-8 text-center font-heading text-2xl font-bold text-bareeq-navy">
                {{ tr('site.pages.programs.services_h2') }}
            </h2>
            <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
                @foreach (
                    [
                        '&#9992;&#65039;',
                        '&#128196;',
                        '&#128506;&#65039;',
                        '&#128172;',
                    ] as $i => $icon
                )
                    @php
                        $n = $i + 1;
                    @endphp
                    <div
                        class="glass-panel-dark rounded-2xl p-6 transition duration-300 hover:-translate-y-1 hover:border-amber-300/50"
                    >
                        <div class="mb-3 text-3xl" aria-hidden="true">{!! $icon !!}</div>
                        <h3 class="mb-2 font-bold text-bareeq-navy">
                            {{ tr('site.pages.programs.service_'.$n.'_title') }}
                        </h3>
                        <p class="text-sm leading-relaxed text-slate-600">
                            {{ tr('site.pages.programs.service_'.$n.'_desc') }}
                        </p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    @include('partials.slider-bareeq', [
        'name' => 'programs-page',
        'title' => tr('site.pages.programs.grid_title'),
        'subtitle' => tr('site.pages.programs.grid_subtitle'),
        'items' => $tripShowcaseItems,
        'theme' => 'trips',
        'layout' => 'grid',
    ])
@endsection
