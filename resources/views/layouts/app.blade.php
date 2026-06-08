<!DOCTYPE html>
<html
    lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    dir="{{ app()->getLocale() === 'en' ? 'ltr' : 'rtl' }}"
    class="scroll-smooth"
>
    @php
        $siteSettings = site_settings();
        $defaultMeta = site_setting_localized('default_meta', tr('site.default_meta')) ?? tr('site.default_meta');
        $defaultTitle = site_setting_localized('site_name', tr('site.site_name')) ?? tr('site.site_name');
        $faviconUrl = $siteSettings->resolvedFaviconUrl(asset('images/albareeq-logo.png')) ?? asset('images/albareeq-logo.png');
        $metaDescription = trim((string) $__env->yieldContent('meta_description', $defaultMeta));
        $metaTitle = trim((string) $__env->yieldContent('title', $defaultTitle));
        $canonicalUrl = url()->current();
        $alternateEn = app()->getLocale() === 'en' ? $canonicalUrl : alternate_locale_url('en');
        $alternateAr = app()->getLocale() === 'ar' ? $canonicalUrl : alternate_locale_url('ar');
        $shareImage = $siteSettings->resolvedLogoUrl(asset('images/albareeq-logo.png')) ?? asset('images/albareeq-logo.png');
        $routeName = (string) optional(request()->route())->getName();
        $keywordsByRoute = [
            'home' => 'البريق,السفر,السياحة,حجز طيران,تأشيرات,عروض سفر',
            'en.home' => 'albareeq,travel,tourism,flights,visas,travel offers',
            'about' => 'من نحن,البريق,وكالة سفر,IATA',
            'en.about' => 'about,albareeq,travel agency,IATA',
            'programs' => 'برامج سياحية,رحلات,باقات سفر',
            'en.programs' => 'tour programs,packages,trips',
            'hotels' => 'فنادق,حجز فنادق,إقامة',
            'en.hotels' => 'hotels,hotel booking,stays',
            'destinations' => 'وجهات سفر,سياحة خارجية',
            'en.destinations' => 'destinations,international travel',
            'visas' => 'تأشيرات,فيزا,استخراج تأشيرة',
            'en.visas' => 'visas,visa services,visa application',
            'offers' => 'عروض سفر,خصومات,عروض سياحة',
            'en.offers' => 'travel offers,discounts,promotions',
            'blog' => 'مدونة سفر,نصائح سفر',
            'en.blog' => 'travel blog,travel tips',
            'blog.show' => 'مقال سفر,نصيحة سفر',
            'en.blog.show' => 'travel article,travel guide',
            'news' => 'أخبار,إعلانات,شركة سفر',
            'en.news' => 'news,announcements,travel company',
            'news.show' => 'خبر,إعلان,مستجدات',
            'en.news.show' => 'news update,announcement',
        ];
        $defaultKeywords = app()->getLocale() === 'en'
            ? 'travel agency,flights,visas,hotels,tourism'
            : 'وكالة سفر,حجوزات,تأشيرات,فنادق,سياحة';
        $metaKeywords = trim((string) $__env->yieldContent('meta_keywords', $keywordsByRoute[$routeName] ?? $defaultKeywords));
        $derivedOgType = in_array($routeName, ['blog.show', 'en.blog.show', 'news.show', 'en.news.show'], true) ? 'article' : 'website';
        $ogType = trim((string) $__env->yieldContent('og_type', $derivedOgType));
        $ogLocale = app()->getLocale() === 'en' ? 'en_US' : 'ar_SA';
        $socialHandle = trim((string) ($siteSettings->social_x ?? ''));
        $twitterHandle = '';
        if ($socialHandle !== '') {
            $parts = parse_url($socialHandle);
            $path = trim((string) ($parts['path'] ?? ''), '/');
            if ($path !== '') {
                $twitterHandle = '@'.ltrim(explode('/', $path)[0] ?? '', '@');
            }
        }
    @endphp
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="description" content="{{ $metaDescription }}" />
        @if ($metaKeywords !== '')
            <meta name="keywords" content="{{ $metaKeywords }}" />
        @endif
        <meta name="robots" content="@yield('meta_robots', 'index,follow,max-image-preview:large')" />
        <meta name="author" content="{{ $defaultTitle }}" />
        <meta name="referrer" content="strict-origin-when-cross-origin" />
        <meta name="theme-color" content="#f6f8fb" />
        <title>{{ $metaTitle }}</title>
        <link rel="canonical" href="{{ $canonicalUrl }}" />
        <link rel="alternate" hreflang="ar" href="{{ $alternateAr }}" />
        <link rel="alternate" hreflang="en" href="{{ $alternateEn }}" />
        <link rel="alternate" hreflang="x-default" href="{{ $alternateAr }}" />
        <link rel="icon" type="image/png" href="{{ $faviconUrl }}" />
        <meta property="og:type" content="{{ $ogType }}" />
        <meta property="og:locale" content="{{ $ogLocale }}" />
        <meta property="og:locale:alternate" content="{{ app()->getLocale() === 'en' ? 'ar_SA' : 'en_US' }}" />
        <meta property="og:site_name" content="{{ $defaultTitle }}" />
        <meta property="og:title" content="{{ $metaTitle }}" />
        <meta property="og:description" content="{{ $metaDescription }}" />
        <meta property="og:url" content="{{ $canonicalUrl }}" />
        <meta property="og:image" content="{{ $shareImage }}" />
        <meta property="og:image:alt" content="{{ $metaTitle }}" />
        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:title" content="{{ $metaTitle }}" />
        <meta name="twitter:description" content="{{ $metaDescription }}" />
        <meta name="twitter:image" content="{{ $shareImage }}" />
        <meta name="twitter:url" content="{{ $canonicalUrl }}" />
        @if ($twitterHandle !== '')
            <meta name="twitter:site" content="{{ $twitterHandle }}" />
            <meta name="twitter:creator" content="{{ $twitterHandle }}" />
        @endif
        <link rel="dns-prefetch" href="//images.unsplash.com" />
        <link rel="preconnect" href="https://fonts.bunny.net" crossorigin />
        <link
            href="https://fonts.bunny.net/css?family=cairo:400,500,600,700,800|tajawal:400,500,700,800"
            rel="stylesheet"
        />
        <script type="application/ld+json">
            {!! json_encode([
                '@context' => 'https://schema.org',
                '@type' => 'TravelAgency',
                'name' => $defaultTitle,
                'url' => url('/'),
                'logo' => $shareImage,
                'contactPoint' => [
                    '@type' => 'ContactPoint',
                    'contactType' => 'customer support',
                    'telephone' => (string) site_settings()->phone_primary,
                ],
                'sameAs' => array_values(array_filter([
                    (string) site_settings()->social_instagram,
                    (string) site_settings()->social_facebook,
                    (string) site_settings()->social_snapchat,
                    (string) site_settings()->social_x,
                    (string) site_settings()->social_linkedin,
                    (string) site_settings()->social_youtube,
                    (string) site_settings()->social_tiktok,
                ])),
            ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}
        </script>
        @stack('head')
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
    </head>
    <body
        data-whatsapp-number="{{ preg_replace('/\D+/', '', (string) site_settings()->whatsapp_number) ?: '966532352749' }}"
        class="flex min-h-screen flex-col text-slate-800 antialiased selection:bg-amber-400/30"
    >
        <div
            class="pointer-events-none fixed inset-0 -z-10 bg-[var(--background-image-hero-mesh)] opacity-55"
            aria-hidden="true"
        ></div>
        <div
            class="pointer-events-none fixed inset-0 -z-10 bg-[radial-gradient(ellipse_100%_60%_at_50%_-10%,color-mix(in_srgb,#38b6e8_12%,transparent),transparent_50%)]"
            aria-hidden="true"
        ></div>
        <div
            class="pointer-events-none fixed inset-0 -z-10 bg-[radial-gradient(ellipse_80%_50%_at_100%_80%,color-mix(in_srgb,#f4c16a_8%,transparent),transparent_45%)]"
            aria-hidden="true"
        ></div>

        <a
            href="{{ site_whatsapp_url() }}"
            class="fixed bottom-6 start-6 z-50 flex h-14 w-14 items-center justify-center rounded-full bg-emerald-500 text-2xl shadow-lg shadow-emerald-900/40 transition hover:scale-105 hover:bg-emerald-400 md:bottom-8 md:start-8"
            target="_blank"
            rel="noopener noreferrer"
            aria-label="{{ tr('site.contact.wa') }}"
        >
            <span aria-hidden="true">&#128172;</span>
        </a>

        @include('partials.top-bar')
        @include('partials.header')

        <main class="flex-1">
            @yield('content')
        </main>

        @include('partials.footer')
    </body>
</html>
