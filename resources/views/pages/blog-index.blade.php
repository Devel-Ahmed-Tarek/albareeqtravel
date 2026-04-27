@extends('layouts.app')

@section('title', tr('site.pages.blog') . ' | ' . config('app.name'))

@section('meta_description', app()->getLocale() === 'ar' ? 'مقالات ونصائح سفر من فريق البريق.' : 'Travel tips and articles from AlBareeq.')

@section('content')
    <div class="border-b border-slate-200/80 py-12 md:py-16">
        <div class="mx-auto max-w-3xl px-4 text-center md:px-6">
            <h1 class="font-heading text-3xl font-bold text-bareeq-navy md:text-4xl">{{ tr('site.pages.blog') }}</h1>
            <p class="mt-3 text-slate-600">{{ tr('site.pages.blog_lead') }}</p>
        </div>
    </div>

    <section class="py-12 md:py-20" aria-label="{{ tr('site.nav.blog') }}" data-reveal>
        <div class="mx-auto max-w-6xl px-4 md:px-6">
            <ul class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3" role="list">
                @foreach ($posts as $post)
                    <li>
                        <a
                            href="{{ localized_route('blog.show', $post->slug) }}"
                            class="glass-panel-dark group flex h-full flex-col overflow-hidden rounded-2xl transition duration-300 hover:-translate-y-1 hover:border-amber-300/50"
                        >
                            <div
                                class="aspect-[16/10] bg-slate-200 bg-cover bg-center transition duration-500 group-hover:scale-[1.02]"
                                @if($post->image) style="background-image: url('{{ $post->image }}');" @endif
                                role="img"
                            ></div>
                            <div class="flex flex-1 flex-col p-5">
                                <p class="text-xs font-medium text-slate-500">
                                    @if($post->published_at)
                                        {{ $post->published_at->locale(app()->getLocale())->translatedFormat('j F Y') }}
                                    @endif
                                </p>
                                <h2 class="mt-1 font-heading text-lg font-bold text-bareeq-navy group-hover:text-bareeq-blue">
                                    {{ $post->t('title') }}
                                </h2>
                                <p class="mt-2 flex-1 text-sm leading-relaxed text-slate-600">
                                    {{ $post->t('excerpt') }}
                                </p>
                                <span
                                    class="mt-4 inline-block text-sm font-semibold text-bareeq-blue group-hover:text-amber-800"
                                >
                                    {{ tr('site.read_article') }} →
                                </span>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>
@endsection
