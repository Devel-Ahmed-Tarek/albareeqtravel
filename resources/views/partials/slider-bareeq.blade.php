@php
    $uid = 'embla-' . ($name ?? 'slide');
    $title = $title ?? '';
    $subtitle = $subtitle ?? null;
    $items = $items ?? [];
    $autoplay = $autoplay ?? 5000;
    $theme = $theme ?? 'default';
    $layout = $layout ?? 'carousel';
    $variant = $variant ?? '';
    $sectionClass = match ($variant) {
        'sky' => 'bareeq-section bareeq-section--sky',
        'warm' => 'bareeq-section bareeq-section--warm',
        'soft' => 'bareeq-section bareeq-section--soft',
        default => 'bareeq-section',
    };
@endphp

<section
    class="{{ $sectionClass }} py-16 md:py-24"
    data-reveal
    aria-labelledby="heading-{{ $uid }}"
>
    <div class="mx-auto max-w-7xl px-4 md:px-6">
        <div class="mb-8 flex flex-col items-center text-center md:mb-10">
            <p
                class="mb-2 inline-flex items-center gap-2 rounded-full border border-amber-300/50 bg-amber-50 px-3 py-1 text-xs font-medium text-amber-900/90"
            >
                <span class="h-1 w-1 rounded-full bg-amber-500 shadow-[0_0_6px_#d97706]"></span>
                @if ($theme === 'trips')
                    {{ tr('site.slider.kicker_trips') }}
                @elseif ($theme === 'reviews')
                    {{ tr('site.slider.kicker_reviews') }}
                @elseif ($theme === 'hotels')
                    {{ tr('site.slider.kicker_hotels') }}
                @elseif ($theme === 'destinations')
                    {{ tr('site.slider.kicker_destinations') }}
                @else
                    {{ tr('site.slider.kicker_default') }}
                @endif
            </p>
            <h2 id="heading-{{ $uid }}" class="font-heading text-2xl font-bold text-bareeq-navy md:text-3xl lg:text-4xl">
                {!! $title !!}
            </h2>
            @if ($subtitle)
                <p class="mt-2 max-w-2xl text-slate-600">{{ $subtitle }}</p>
            @endif
        </div>

        @if ($layout === 'grid')
            <div
                class="grid grid-cols-1 gap-4 sm:grid-cols-2 sm:gap-5 lg:grid-cols-3 lg:gap-6"
            >
                @foreach ($items as $item)
                    <div class="min-h-0">
                        @include('partials.slider-bareeq-item', ['item' => $item])
                    </div>
                @endforeach
            </div>
        @else
            <div
                class="embla-wrap group/slider relative"
                data-embla-root
                data-embla-id="{{ $uid }}"
                @if ($autoplay) data-embla-autoplay="{{ (int) $autoplay }}" @endif
            >
                <div
                    class="embla__viewport embla__viewport--bareeq overflow-hidden rounded-2xl [mask-image:linear-gradient(90deg,transparent_0%,#000_3%,#000_97%,transparent_100%)] md:[mask-image:none]"
                >
                    <div
                        class="embla__container embla__container--bareeq flex touch-pan-y [gap:0.75rem] md:gap-4 lg:gap-5"
                    >
                        @foreach ($items as $item)
                            <div
                                class="embla__slide embla__slide--bareeq min-w-0 shrink-0 grow-0 select-none [flex-basis:min(100%,20rem)] sm:[flex-basis:min(100%,24rem)] lg:[flex-basis:min(100%,30%)]"
                            >
                                @include('partials.slider-bareeq-item', ['item' => $item])
                            </div>
                        @endforeach
                    </div>
                </div>

                <div
                    class="mt-5 flex items-center justify-center gap-2 md:mt-6 md:gap-3"
                >
                    <button
                        type="button"
                        class="embla__prev inline-flex h-10 w-10 items-center justify-center rounded-xl border border-slate-200 bg-white text-bareeq-navy shadow-sm transition hover:border-amber-300 hover:bg-amber-50 md:h-11 md:w-11"
                        data-embla-prev
                        aria-label="{{ tr('site.slider.prev_slide') }}"
                    >
                        <svg class="h-5 w-5 -scale-x-100" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"
                            ><path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M9 5l7 7-7 7"
                            /></svg
                        >
                    </button>
                    <div
                        class="embla__dots flex min-h-[0.5rem] min-w-0 flex-1 flex-wrap items-center justify-center gap-1.5 px-1 sm:max-w-sm sm:flex-initial"
                        data-embla-dots
                    ></div>
                    <button
                        type="button"
                        class="embla__next inline-flex h-10 w-10 items-center justify-center rounded-xl border border-slate-200 bg-white text-bareeq-navy shadow-sm transition hover:border-amber-300 hover:bg-amber-50 md:h-11 md:w-11"
                        data-embla-next
                        aria-label="{{ tr('site.slider.next_slide') }}"
                    >
                        <svg class="h-5 w-5 -scale-x-100" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"
                            ><path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M15 19l-7-7 7-7"
                            /></svg
                        >
                    </button>
                </div>
            </div>
        @endif
    </div>
</section>
