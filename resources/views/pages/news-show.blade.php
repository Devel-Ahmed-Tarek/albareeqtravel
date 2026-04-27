@extends('layouts.app')

@section('title', $item->t('title') . ' | ' . tr('site.pages.news') . ' | ' . config('app.name'))

@section('meta_description', \Illuminate\Support\Str::limit(strip_tags($item->t('excerpt')), 160))

@section('content')
    <article>
        <div class="border-b border-slate-200/80 py-10 md:py-14">
            <div class="mx-auto max-w-3xl px-4 text-center md:px-6">
                <p class="text-sm text-amber-800/90">{{ tr('site.news_badge') }}</p>
                <p class="mt-1 text-sm text-slate-500">
                    <a href="{{ localized_route('news') }}" class="text-bareeq-blue hover:text-amber-800"
                        >{{ tr('site.nav.news') }}</a
                    >
                    <span class="mx-1 text-slate-400" aria-hidden="true">/</span>
                    <span class="text-slate-500">
                        @if($item->published_at)
                            {{ $item->published_at->locale(app()->getLocale())->translatedFormat('j F Y') }}
                        @endif
                    </span>
                </p>
                <h1 class="mt-3 font-heading text-2xl font-bold text-bareeq-navy md:text-4xl">
                    {{ $item->t('title') }}
                </h1>
                <p class="mt-3 text-slate-600">{{ $item->t('excerpt') }}</p>
            </div>
        </div>

        @if ($item->image)
            <div
                class="min-h-[12rem] w-full bg-cover bg-center md:min-h-[18rem]"
                style="background-image: url('{{ $item->image }}');"
            ></div>
        @endif

        <div
            class="prose-article mx-auto max-w-3xl px-4 py-12 text-slate-700 md:px-6 md:py-16"
            data-reveal
        >
            {!! $item->t('body') !!}
        </div>

        <div class="border-t border-slate-200/80 py-10">
            <div class="mx-auto max-w-3xl px-4 text-center md:px-6">
                <a
                    href="{{ localized_route('news') }}"
                    class="inline-flex items-center gap-2 text-sm font-semibold text-amber-800 hover:text-amber-700"
                >
                    {{ tr('site.all_news') }}
                </a>
            </div>
        </div>
    </article>
@endsection
