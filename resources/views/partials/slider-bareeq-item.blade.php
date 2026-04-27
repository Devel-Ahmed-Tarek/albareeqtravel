@if (($item['type'] ?? '') === 'review')
    <div
        class="glass-panel-dark relative h-full overflow-hidden rounded-2xl p-5 shadow-md shadow-slate-900/5"
    >
        <div
            class="absolute -end-6 -top-6 h-24 w-24 rounded-full bg-amber-200/30 blur-2xl"
            aria-hidden="true"
        ></div>
        <div
            class="mb-3 flex text-amber-500"
            role="img"
            aria-label="{{ tr('site.slider.rating_aria', ['n' => (int) ($item['rating'] ?? 5)]) }}"
        >
            @for ($i = 0; $i < (int) ($item['rating'] ?? 5); $i++)
                <span class="text-lg leading-none" aria-hidden="true">&#9733;</span>
            @endfor
        </div>
        <p class="mb-4 text-sm leading-relaxed text-slate-700 md:text-base">«{{ $item['quote'] }}»</p>
        <div class="mt-auto flex items-center gap-3 border-t border-slate-200/80 pt-3">
            <div
                class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-sky-200/80 to-amber-100 text-sm font-bold text-bareeq-navy"
            >
                {{ $item['initial'] ?? 'ب' }}
            </div>
            <div>
                <p class="font-bold text-bareeq-navy">{{ $item['name'] }}</p>
                <p class="text-xs text-slate-500">{{ $item['from'] ?? '' }}</p>
            </div>
        </div>
    </div>
@else
    <a
        href="{{ $item['url'] ?? localized_route('destinations') }}"
        class="bareeq-card-shine embla__card-link group/card relative block h-full min-h-[18rem] overflow-hidden rounded-2xl border border-slate-200/80 bg-slate-100 shadow-lg transition will-change-transform [transform:translateZ(0)]"
    >
        <div
            class="absolute inset-0 z-0 bg-cover bg-center transition duration-500 group-hover/card:scale-105"
            style="background-image: url('{{ e($item['image']) }}');"
        ></div>
        <div
            class="absolute inset-0 z-10 bg-gradient-to-t from-bareeq-navy/85 via-bareeq-navy/25 to-slate-900/0"
        ></div>
        @if (! empty($item['badge']))
            <span
                class="absolute end-3 top-3 z-20 rounded-full border border-amber-300/50 bg-amber-50/95 px-2.5 py-0.5 text-xs font-semibold text-amber-900/95 backdrop-blur-sm"
            >
                {{ $item['badge'] }}
            </span>
        @endif
        <div
            class="absolute inset-x-0 bottom-0 z-20 p-4 md:p-5"
        >
            <h3 class="font-heading text-lg font-bold text-white drop-shadow-sm md:text-xl">
                {{ $item['title'] }}
            </h3>
            <p class="mt-1 text-sm text-slate-100/95 drop-shadow-sm">{{ $item['desc'] ?? '' }}</p>
            <span
                class="mt-2 inline-block text-sm font-semibold text-sky-200 transition group-hover/card:text-amber-200"
            >{{ tr('site.slider.card_cta') }}</span>
        </div>
    </a>
@endif
