@php
    $slides = $slides ?? [];
    $uid = 'embla-hero-main';
    $autoplay = $autoplay ?? 6500;
@endphp

<section
    class="relative min-h-[85vh] overflow-hidden border-b border-slate-200/80 bg-slate-200"
    aria-label="سلايدر الترحيب"
>
    <div
        class="pointer-events-none absolute start-[10%] top-1/4 z-[1] h-40 w-40 rounded-full bg-sky-400/20 blur-3xl animate-[bareeq-pulse-glow_4s_ease-in-out_infinite]"
        aria-hidden="true"
    ></div>
    <div
        class="pointer-events-none absolute end-[15%] bottom-1/3 z-[1] h-56 w-56 rounded-full bg-amber-400/15 blur-3xl animate-[bareeq-float_6s_ease-in-out_infinite]"
        aria-hidden="true"
    ></div>

    <div
        class="embla-hero embla-wrap group/slider relative z-[2] min-h-[85vh]"
        data-embla-root
        data-embla-id="{{ $uid }}"
        @if ($autoplay) data-embla-autoplay="{{ (int) $autoplay }}" @endif
    >
        <div
            class="embla__viewport embla-hero__viewport h-full min-h-[85vh] w-full overflow-hidden"
        >
            <div
                class="embla__container embla-hero__container flex h-full min-h-[85vh] touch-pan-y"
            >
                @foreach ($slides as $i => $s)
                    <div
                        class="embla__slide embla-hero__slide min-h-[85vh] w-full min-w-0 shrink-0 grow-0 select-none"
                    >
                        <div class="relative min-h-[85vh] w-full">
                            <div
                                class="absolute inset-0 z-0 bg-cover bg-center"
                                style="background-image: url('{{ e($s['image']) }}');"
                                role="img"
                                aria-label="{{ $s['image_label'] ?? 'خلفية' }}"
                            ></div>
                            <div
                                class="absolute inset-0 z-10 bg-gradient-to-b from-bareeq-midnight/45 via-bareeq-navy/30 to-bareeq-midnight/50"
                            ></div>
                            <div
                                class="absolute inset-0 z-10 bg-gradient-to-l from-amber-400/6 via-transparent to-sky-400/12 mix-blend-soft-light"
                            ></div>

                            <div
                                class="home-hero-animate relative z-20 mx-auto flex min-h-[85vh] max-w-5xl flex-col justify-center px-4 pb-28 pt-16 md:px-6 md:pb-32"
                            >
                                <p
                                    class="mb-3 inline-flex w-fit items-center gap-2 rounded-full border border-amber-400/40 bg-white/20 px-4 py-1.5 text-sm text-amber-100 backdrop-blur-sm"
                                >
                                    <span
                                        class="h-1.5 w-1.5 rounded-full bg-amber-300 shadow-[0_0_12px_#fbbf24]"
                                        aria-hidden="true"
                                    ></span>
                                    {{ $s['kicker'] ?? 'البريق' }}
                                </p>

                                @if ($i === 0)
                                    <h1
                                        id="hero-heading"
                                        class="mb-6 font-heading text-4xl font-extrabold leading-tight drop-shadow-sm md:text-5xl lg:text-6xl"
                                    >
                                        <span
                                            class="bareeq-gradient-text inline-block text-white [text-shadow:none]"
                                        >{{ $s['title'] ?? '' }}</span>
                                    </h1>
                                @else
                                    <h2
                                        class="mb-6 font-heading text-4xl font-extrabold leading-tight drop-shadow-sm md:text-5xl lg:text-6xl"
                                    >
                                        <span
                                            class="bareeq-gradient-text inline-block text-white [text-shadow:none]"
                                        >{{ $s['title'] ?? '' }}</span>
                                    </h2>
                                @endif

                                <p
                                    class="home-hero-lead mb-8 max-w-2xl text-lg leading-relaxed text-slate-100 drop-shadow-sm md:text-xl"
                                >
                                    {!! nl2br(e($s['lead'] ?? '')) !!}
                                </p>
                                <div class="flex flex-wrap items-center gap-4">
                                    @if (! empty($s['primary_href']))
                                        <a
                                            href="{{ $s['primary_href'] }}"
                                            class="group relative inline-flex items-center justify-center overflow-hidden rounded-2xl bg-gradient-to-l from-amber-500 to-amber-600 px-8 py-3.5 text-lg font-bold text-bareeq-midnight shadow-lg shadow-amber-900/30 transition hover:from-amber-400 hover:to-amber-500"
                                        >
                                            <span class="relative z-10">{{ $s['primary_label'] ?? 'تعرّف أكثر' }}</span>
                                        </a>
                                    @endif
                                    @if (! empty($s['secondary_href']))
                                        <a
                                            href="{{ $s['secondary_href'] }}"
                                            class="inline-flex items-center justify-center rounded-2xl border-2 border-white/50 bg-white/12 px-8 py-3.5 text-lg font-semibold text-sky-50 backdrop-blur transition hover:border-amber-200/60 hover:text-amber-100"
                                        >
                                            {{ $s['secondary_label'] ?? 'المزيد' }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        @if (count($slides) > 1)
            <div
                class="absolute bottom-6 start-0 end-0 z-30 flex items-center justify-center gap-2 px-4 md:bottom-8 md:gap-3"
            >
                <button
                    type="button"
                    class="embla__prev inline-flex h-10 w-10 items-center justify-center rounded-xl border border-slate-200 bg-white/90 text-bareeq-navy shadow-md shadow-slate-900/10 transition hover:border-amber-300 hover:bg-amber-50 md:h-11 md:w-11"
                    data-embla-prev
                    aria-label="الشريحة السابقة"
                >
                    <svg
                        class="h-5 w-5 -scale-x-100"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                        aria-hidden="true"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M9 5l7 7-7 7"
                        />
                    </svg>
                </button>
                <div
                    class="embla__dots flex min-h-[0.5rem] min-w-0 max-w-[min(100%,18rem)] flex-1 flex-wrap items-center justify-center gap-1.5 px-1 sm:max-w-sm sm:flex-initial"
                    data-embla-dots
                ></div>
                <button
                    type="button"
                    class="embla__next inline-flex h-10 w-10 items-center justify-center rounded-xl border border-slate-200 bg-white/90 text-bareeq-navy shadow-md shadow-slate-900/10 transition hover:border-amber-300 hover:bg-amber-50 md:h-11 md:w-11"
                    data-embla-next
                    aria-label="الشريحة التالية"
                >
                    <svg
                        class="h-5 w-5 -scale-x-100"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                        aria-hidden="true"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M15 19l-7-7 7-7"
                        />
                    </svg>
                </button>
            </div>
        @endif
    </div>
</section>
