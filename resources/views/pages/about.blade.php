@extends('layouts.app')

@section('title', tr('site.pages.about.title'))

@section('meta_description', tr('site.pages.about.meta_description'))

@section('content')
    <div class="bareeq-page-head py-12 md:py-16">
        <div class="mx-auto max-w-3xl px-4 text-center md:px-6">
            <h1 class="font-heading text-3xl font-bold text-bareeq-navy md:text-4xl">
                {{ tr('site.pages.about.h1') }}
            </h1>
            <p class="mt-3 text-slate-600">{{ tr('site.pages.about.intro') }}</p>
        </div>
    </div>

    <section class="bareeq-section py-16 md:py-24" aria-labelledby="about-why">
        <div class="mx-auto max-w-6xl px-4 md:px-6">
            <h2 id="about-why" class="mb-8 text-center font-heading text-2xl font-bold text-bareeq-navy md:text-3xl">
                {!! tr('site.pages.about.why_title') !!}
            </h2>
            <div class="grid gap-6 md:grid-cols-2">
                <div class="glass-panel-dark relative overflow-hidden rounded-3xl p-8">
                    <h3 class="mb-3 font-heading text-xl font-bold text-bareeq-navy">
                        {{ tr('site.pages.about.detail_h3') }}
                    </h3>
                    <p class="leading-relaxed text-slate-700">
                        {{ tr('site.pages.about.detail_p') }}
                    </p>
                </div>
                <div
                    class="flex flex-col justify-center rounded-3xl border border-sky-200/60 bg-gradient-to-br from-sky-50 to-amber-50/40 p-8"
                >
                    <p class="mb-1 text-sm font-medium uppercase tracking-wider text-bareeq-blue/90">
                        {{ tr('site.pages.about.creds_kicker') }}
                    </p>
                    <p class="font-heading text-2xl font-bold text-bareeq-navy">
                        {{ tr('site.pages.about.creds_h3') }}
                    </p>
                    <p class="mt-2 text-slate-700">{{ tr('site.pages.about.creds_p') }}</p>
                </div>
            </div>
        </div>
    </section>

    <section class="bareeq-section bareeq-section--sky py-16 md:py-20" aria-labelledby="values">
        <div class="mx-auto max-w-6xl px-4 md:px-6">
            <h2 id="values" class="mb-8 text-center font-heading text-2xl font-bold text-bareeq-navy">
                {{ tr('site.pages.about.values_h2') }}
            </h2>
            <ul class="grid gap-4 md:grid-cols-3">
                <li class="glass-panel-dark rounded-2xl p-6">
                    <h3 class="mb-1 font-bold text-bareeq-navy">{{ tr('site.pages.about.value1_h3') }}</h3>
                    <p class="text-sm text-slate-600">{{ tr('site.pages.about.value1_p') }}</p>
                </li>
                <li class="glass-panel-dark rounded-2xl p-6">
                    <h3 class="mb-1 font-bold text-bareeq-navy">{{ tr('site.pages.about.value2_h3') }}</h3>
                    <p class="text-sm text-slate-600">{{ tr('site.pages.about.value2_p') }}</p>
                </li>
                <li class="glass-panel-dark rounded-2xl p-6">
                    <h3 class="mb-1 font-bold text-bareeq-navy">{{ tr('site.pages.about.value3_h3') }}</h3>
                    <p class="text-sm text-slate-600">{{ tr('site.pages.about.value3_p') }}</p>
                </li>
            </ul>
        </div>
    </section>
@endsection
