@extends('layouts.app')

@section('title', tr('site.pages.visas.title'))

@section('meta_description', tr('site.pages.visas.meta_description'))

@section('content')
    <div class="border-b border-slate-200/80 py-12 md:py-16">
        <div class="mx-auto max-w-4xl px-4 text-center md:px-6">
            <h1 class="font-heading text-3xl font-bold text-bareeq-navy md:text-4xl">{{ tr('site.pages.visas.h1') }}</h1>
            <p class="mt-3 text-slate-600">{{ tr('site.pages.visas.intro') }}</p>
        </div>
    </div>

    <section class="py-12 md:py-20" data-reveal aria-label="{{ tr('site.nav.visas') }}">
        <div class="mx-auto max-w-6xl px-4 md:px-6">
            <div class="mb-8 flex flex-wrap gap-2">
                <a
                    href="{{ localized_route('visas') }}"
                    @class([
                        'rounded-full border px-4 py-2 text-sm font-semibold transition',
                        'border-sky-500 bg-sky-100 text-bareeq-navy' => $activeCategorySlug === '',
                        'border-slate-300 text-slate-600 hover:border-amber-400 hover:text-amber-800' => $activeCategorySlug !== '',
                    ])
                >
                    {{ tr('site.pages.visas.filter_all') }}
                </a>

                @foreach ($categories as $category)
                    <a
                        href="{{ localized_route('visas', ['category' => $category->slug]) }}"
                        @class([
                            'rounded-full border px-4 py-2 text-sm font-semibold transition',
                            'border-sky-500 bg-sky-100 text-bareeq-navy' => $activeCategorySlug === $category->slug,
                            'border-slate-300 text-slate-600 hover:border-amber-400 hover:text-amber-800' => $activeCategorySlug !== $category->slug,
                        ])
                    >
                        {{ $category->t('name') }}
                    </a>
                @endforeach
            </div>

            @if ($visas->isEmpty())
                <p class="rounded-2xl border border-slate-200 bg-white p-5 text-center text-slate-500">
                    {{ tr('site.pages.visas.empty') }}
                </p>
            @else
                <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($visas as $visa)
                        @include('partials.visa-card', ['visa' => $visa])
                    @endforeach
                </div>
            @endif
        </div>
    </section>
@endsection
