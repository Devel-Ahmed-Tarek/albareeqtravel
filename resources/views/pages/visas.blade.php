@extends('layouts.app')

@section('title', tr('site.pages.visas.title'))

@section('meta_description', tr('site.pages.visas.meta_description'))

@section('content')
    <div class="bareeq-page-head py-12 md:py-16">
        <div class="mx-auto max-w-3xl px-4 text-center md:px-6">
            <p
                class="mb-3 inline-flex items-center gap-2 rounded-full border border-sky-200/80 bg-white/70 px-3 py-1 text-xs font-semibold text-bareeq-blue"
            >
                <span class="h-1.5 w-1.5 rounded-full bg-emerald-400 shadow-[0_0_6px_#34d399]" aria-hidden="true"></span>
                {{ tr('site.nav.visas') }}
            </p>
            <h1 class="font-heading text-3xl font-bold text-bareeq-navy md:text-4xl">{{ tr('site.pages.visas.h1') }}</h1>
            <p class="mt-3 text-slate-600">{{ tr('site.pages.visas.intro') }}</p>
        </div>
    </div>

    <section class="bareeq-section bareeq-section--sky py-10 md:py-14" aria-labelledby="visa-steps">
        <div class="mx-auto max-w-6xl px-4 md:px-6">
            <h2 id="visa-steps" class="sr-only">{{ tr('site.pages.visas.steps_title') }}</h2>
            <ol class="grid gap-4 md:grid-cols-3 md:gap-6" role="list">
                @foreach (['step1', 'step2', 'step3'] as $index => $stepKey)
                    <li
                        class="flex items-start gap-4 rounded-2xl border border-white/60 bg-white/70 p-4 shadow-sm shadow-sky-900/5 backdrop-blur-sm md:p-5"
                    >
                        <span
                            class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-gradient-to-br from-sky-100 to-amber-50 font-heading text-lg font-bold text-bareeq-blue"
                            aria-hidden="true"
                        >{{ $index + 1 }}</span>
                        <div>
                            <p class="font-semibold text-bareeq-navy">{{ tr('site.pages.visas.'.$stepKey.'_title') }}</p>
                            <p class="mt-1 text-sm text-slate-600">{{ tr('site.pages.visas.'.$stepKey.'_desc') }}</p>
                        </div>
                    </li>
                @endforeach
            </ol>
        </div>
    </section>

    <section class="bareeq-section py-8 md:py-10" aria-label="{{ tr('site.pages.visas.filter_label') }}">
        <div class="mx-auto max-w-6xl px-4 md:px-6">
            <div
                class="rounded-2xl border border-slate-200/80 bg-white/80 p-4 shadow-sm shadow-sky-900/5 backdrop-blur-sm md:p-5"
            >
                <div class="mb-3 flex flex-wrap items-center justify-between gap-2">
                    <p class="text-sm font-semibold text-bareeq-navy">{{ tr('site.pages.visas.filter_label') }}</p>
                    @if ($visas->isNotEmpty())
                        <p class="text-sm text-slate-500">
                            {{ trans_choice('site.pages.visas.results', $visas->count(), ['count' => $visas->count()]) }}
                            @if ($activeCategory)
                                <span class="text-bareeq-blue">· {{ $activeCategory->t('name') }}</span>
                            @endif
                        </p>
                    @endif
                </div>
                <div class="flex gap-2 overflow-x-auto pb-1 [-ms-overflow-style:none] [scrollbar-width:none] [&::-webkit-scrollbar]:hidden">
                    <a
                        href="{{ localized_route('visas') }}"
                        @class([
                            'shrink-0 rounded-full border px-4 py-2 text-sm font-semibold transition',
                            'border-sky-400 bg-sky-100 text-bareeq-navy shadow-sm' => $activeCategorySlug === '',
                            'border-slate-200 bg-white text-slate-600 hover:border-amber-300 hover:text-amber-800' => $activeCategorySlug !== '',
                        ])
                    >
                        {{ tr('site.pages.visas.filter_all') }}
                    </a>

                    @foreach ($categories as $category)
                        <a
                            href="{{ localized_route('visas', ['category' => $category->slug]) }}"
                            @class([
                                'shrink-0 rounded-full border px-4 py-2 text-sm font-semibold transition',
                                'border-sky-400 bg-sky-100 text-bareeq-navy shadow-sm' => $activeCategorySlug === $category->slug,
                                'border-slate-200 bg-white text-slate-600 hover:border-amber-300 hover:text-amber-800' => $activeCategorySlug !== $category->slug,
                            ])
                        >
                            {{ $category->t('name') }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="bareeq-section bareeq-section--soft pb-16 pt-4 md:pb-24 md:pt-6" data-reveal aria-label="{{ tr('site.nav.visas') }}">
        <div class="mx-auto max-w-6xl px-4 md:px-6">
            @if ($visas->isEmpty())
                <div class="rounded-2xl border border-dashed border-slate-300 bg-white/80 px-6 py-14 text-center">
                    <p class="font-heading text-lg font-bold text-bareeq-navy">{{ tr('site.pages.visas.empty') }}</p>
                    <p class="mt-2 text-sm text-slate-500">{{ tr('site.pages.visas.empty_hint') }}</p>
                    <a
                        href="{{ site_whatsapp_url(tr('site.pages.visas.cta_wa')) }}"
                        class="mt-6 inline-flex items-center gap-2 rounded-xl bg-gradient-to-l from-emerald-500 to-emerald-600 px-6 py-3 text-sm font-bold text-white transition hover:from-emerald-400 hover:to-emerald-500"
                        target="_blank"
                        rel="noopener noreferrer"
                    >
                        <span aria-hidden="true">&#128172;</span>
                        {{ tr('site.contact.wa') }}
                    </a>
                </div>
            @else
                <div class="grid gap-6 sm:grid-cols-2 xl:grid-cols-3">
                    @foreach ($visas as $visa)
                        @include('partials.visa-card', ['visa' => $visa])
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <section class="bareeq-section bareeq-section--warm py-14 md:py-20" aria-labelledby="visa-cta">
        <div class="mx-auto max-w-2xl px-4 text-center md:px-6">
            <h2 id="visa-cta" class="font-heading text-2xl font-bold text-bareeq-navy md:text-3xl">
                {{ tr('site.pages.visas.cta_title') }}
            </h2>
            <p class="mt-3 text-slate-600">{{ tr('site.pages.visas.cta_lead') }}</p>
            <a
                href="{{ site_whatsapp_url(tr('site.pages.visas.cta_wa')) }}"
                class="bareeq-cta-sheen mt-6 inline-flex items-center justify-center gap-2 rounded-2xl bg-gradient-to-l from-emerald-500 to-emerald-600 px-8 py-3.5 font-bold text-white shadow-lg shadow-emerald-900/20 transition hover:from-emerald-400 hover:to-emerald-500"
                target="_blank"
                rel="noopener noreferrer"
            >
                <span aria-hidden="true">&#128172;</span>
                {{ tr('site.pages.visas.cta_button') }}
            </a>
        </div>
    </section>
@endsection
