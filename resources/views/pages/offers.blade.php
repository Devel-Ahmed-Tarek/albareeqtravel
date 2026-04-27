@extends('layouts.app')

@section('title', tr('site.pages.offers') . ' | ' . config('app.name'))

@section('meta_description', app()->getLocale() === 'ar' ? 'عروض وخصومات فريق البريق — اسأل واتساب.' : 'AlBareeq travel offers and bundles.')

@section('content')
    <div class="border-b border-slate-200/80 py-12 md:py-16">
        <div class="mx-auto max-w-3xl px-4 text-center md:px-6">
            <h1 class="font-heading text-3xl font-bold text-bareeq-navy md:text-4xl">{{ tr('site.pages.offers') }}</h1>
            <p class="mt-3 text-slate-600">{{ tr('site.pages.offers_lead') }}</p>
        </div>
    </div>

    <section class="py-12 md:py-20" aria-label="{{ tr('site.nav.offers') }}" data-reveal>
        <div class="mx-auto max-w-6xl px-4 md:px-6">
            <div class="grid gap-6 sm:grid-cols-2">
                @foreach ($offers as $offer)
                    <div
                        class="glass-panel-dark group relative flex flex-col overflow-hidden rounded-2xl border border-amber-200/50"
                    >
                        <div class="relative aspect-[16/9] w-full overflow-hidden bg-slate-200">
                            @if ($offer->image)
                                <div
                                    class="absolute inset-0 bg-cover bg-center transition duration-500 group-hover:scale-105"
                                    style="background-image: url('{{ $offer->image }}');"
                                ></div>
                            @endif
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-bareeq-navy/50 to-transparent"
                            ></div>
                            @if ($offer->t('badge') !== '')
                                <span
                                    class="absolute end-3 top-3 rounded-full border border-amber-300/50 bg-amber-50/95 px-2.5 py-0.5 text-xs font-bold text-amber-900"
                                >
                                    {{ $offer->t('badge') }}
                                </span>
                            @endif
                        </div>
                        <div class="flex flex-1 flex-col p-5">
                            <h2 class="font-heading text-lg font-bold text-bareeq-navy md:text-xl">
                                {{ $offer->t('title') }}
                            </h2>
                            <p class="mt-2 flex-1 text-sm leading-relaxed text-slate-600">
                                {{ $offer->t('desc') }}
                            </p>
                            <p class="mt-3 text-xs text-amber-800/90">{{ $offer->t('valid_note') }}</p>
                            <a
                                href="https://wa.me/966532352749?text={{ rawurlencode($offer->t('wa_text') !== '' ? $offer->t('wa_text') : $offer->t('title')) }}"
                                class="mt-4 inline-flex w-full items-center justify-center rounded-2xl bg-gradient-to-l from-amber-500 to-amber-600 py-2.5 text-sm font-bold text-bareeq-midnight shadow-md transition hover:from-amber-400 hover:to-amber-500"
                                target="_blank"
                                rel="noopener noreferrer"
                            >
                                {{ tr('site.whatsapp') }}
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <p class="mt-10 text-center text-sm text-slate-500">
                {{ tr('site.offers.disclaimer') }}
            </p>
        </div>
    </section>
@endsection
