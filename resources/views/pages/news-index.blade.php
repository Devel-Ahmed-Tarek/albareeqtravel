@extends('layouts.app')

@section('title', tr('site.pages.news') . ' | ' . config('app.name'))

@section('meta_description', app()->getLocale() === 'ar' ? 'أخبار وإعلانات شركة البريق.' : 'News and updates from AlBareeq.')

@section('content')
    <div class="border-b border-slate-200/80 py-12 md:py-16">
        <div class="mx-auto max-w-3xl px-4 text-center md:px-6">
            <h1 class="font-heading text-3xl font-bold text-bareeq-navy md:text-4xl">{{ tr('site.pages.news') }}</h1>
            <p class="mt-3 text-slate-600">{{ tr('site.pages.news_lead') }}</p>
        </div>
    </div>

    <section class="py-12 md:py-20" aria-label="{{ tr('site.nav.news') }}" data-reveal>
        <div class="mx-auto max-w-6xl px-4 md:px-6">
            <ul class="space-y-6" role="list">
                @foreach ($items as $n)
                    <li>
                        <a
                            href="{{ localized_route('news.show', $n->slug) }}"
                            class="glass-panel-dark group flex flex-col overflow-hidden rounded-2xl border border-slate-200/80 transition duration-300 hover:border-amber-300/50 md:flex-row"
                        >
                            <div
                                class="aspect-[16/9] w-full shrink-0 bg-slate-200 bg-cover bg-center md:aspect-auto md:min-h-[12rem] md:w-64 lg:w-80"
                                @if($n->image) style="background-image: url('{{ $n->image }}');" @endif
                            ></div>
                            <div class="flex flex-1 flex-col justify-center p-6">
                                <p class="text-xs font-medium text-slate-500">
                                    @if($n->published_at)
                                        {{ $n->published_at->locale(app()->getLocale())->translatedFormat('j F Y') }}
                                    @endif
                                </p>
                                <h2
                                    class="mt-1 font-heading text-xl font-bold text-bareeq-navy group-hover:text-bareeq-blue md:text-2xl"
                                >
                                    {{ $n->t('title') }}
                                </h2>
                                <p class="mt-2 text-slate-600">{{ $n->t('excerpt') }}</p>
                                <span
                                    class="mt-3 text-sm font-semibold text-bareeq-blue group-hover:text-amber-800"
                                >
                                    {{ tr('site.read_detail') }} →
                                </span>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>
@endsection
