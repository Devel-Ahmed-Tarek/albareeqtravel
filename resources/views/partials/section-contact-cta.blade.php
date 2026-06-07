<section
    class="relative overflow-hidden bareeq-section bareeq-section--sky py-20 md:py-28"
    data-reveal
    id="section-contact-cta"
    aria-labelledby="contact-cta-title"
>
    @php
        $settings = site_settings();
        $phonePrimary = $settings->phone_primary ?: '+966 53 235 2749';
    @endphp
    <div
        class="pointer-events-none absolute inset-0 -z-10 bg-[radial-gradient(ellipse_100%_80%_at_50%_100%,color-mix(in_srgb,#f4c16a_18%,transparent),transparent_55%)]"
    ></div>
    <div
        class="absolute start-0 top-1/2 -z-10 h-64 w-64 -translate-y-1/2 rounded-full bg-sky-400/20 blur-3xl motion-safe:animate-pulse"
        style="animation-duration: 5s"
        aria-hidden="true"
    ></div>
    <div
        class="absolute end-0 top-0 -z-10 h-48 w-48 rounded-full bg-amber-300/20 blur-3xl motion-safe:animate-pulse"
        style="animation-duration: 6s; animation-delay: 0.5s"
        aria-hidden="true"
    ></div>

    <div class="relative mx-auto max-w-6xl px-4 md:px-6">
        <div
            class="bareeq-contact-bloom relative overflow-hidden rounded-[1.75rem] border border-sky-200/60 bg-gradient-to-br from-sky-50 via-white to-amber-50/60 p-8 shadow-lg shadow-sky-900/10 md:p-12 lg:p-14"
        >
            <div
                class="absolute -inset-px rounded-[1.75rem] bg-gradient-to-r from-sky-300/20 via-amber-200/25 to-sky-200/20 opacity-90 blur-sm bareeq-bloom-ring"
                aria-hidden="true"
            ></div>
            <div
                class="absolute inset-0 rounded-[1.7rem] bg-white/40"
                style="background: linear-gradient(135deg, color-mix(in srgb, #f0f9ff 92%, transparent), color-mix(in srgb, #fffbeb 88%, transparent))"
                aria-hidden="true"
            ></div>
            <div
                class="absolute bottom-0 end-0 h-32 w-32 rounded-tl-full bg-amber-200/25 blur-2xl"
                aria-hidden="true"
            ></div>
            <div
                class="absolute start-0 top-0 h-24 w-24 rounded-br-full bg-sky-200/30 blur-2xl"
                aria-hidden="true"
            ></div>

            <div class="relative z-10 grid gap-8 lg:grid-cols-2 lg:gap-10 lg:items-center">
                <div>
                    <p
                        class="mb-3 inline-flex items-center gap-2 text-sm font-medium text-amber-800"
                    >
                        <span
                            class="bareeq-twinkle-dot inline-block h-2 w-2 rounded-full bg-amber-500 shadow-[0_0_10px_#d97706]"
                        ></span>
                        {{ tr('site.home.contact_cta_kicker') }}
                    </p>
                    <h2
                        id="contact-cta-title"
                        class="font-heading text-2xl font-bold leading-tight text-bareeq-navy md:text-3xl lg:text-4xl"
                    >
                        {!! tr('site.home.contact_cta_title') !!}
                    </h2>
                    <p class="mt-3 max-w-md text-slate-600">
                        {{ tr('site.home.contact_cta_lead') }}
                    </p>
                    <ul class="mt-6 space-y-2 text-slate-700">
                        <li class="flex items-center gap-2">
                            <span class="text-amber-600" aria-hidden="true">&#128222;</span>
                            <a
                                href="tel:{{ preg_replace('/\s+/', '', $phonePrimary) }}"
                                class="font-semibold text-bareeq-blue transition hover:text-amber-800"
                            >{{ $phonePrimary }}</a
                            >
                        </li>
                        <li class="flex items-center gap-2 text-sm text-slate-500">
                            {{ tr('site.home.contact_cta_branches') }}
                        </li>
                    </ul>
                </div>
                <div class="flex flex-col gap-3 sm:flex-row sm:justify-end lg:flex-col lg:items-stretch">
                    <a
                        href="{{ site_whatsapp_url(tr('site.home.contact_cta_wa_message')) }}"
                        class="bareeq-cta-sheen group inline-flex h-14 items-center justify-center gap-2 rounded-2xl bg-gradient-to-l from-emerald-500 to-emerald-600 px-6 text-lg font-bold text-white shadow-lg shadow-emerald-800/20 transition md:h-16 md:px-8"
                        target="_blank"
                        rel="noopener noreferrer"
                    >
                        <span aria-hidden="true">&#128172;</span>
                        <span>{{ tr('site.contact.wa') }}</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
