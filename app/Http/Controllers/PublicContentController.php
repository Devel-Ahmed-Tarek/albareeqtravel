<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Branch;
use App\Models\CustomerReview;
use App\Models\HeroSlide;
use App\Models\HotelShowcaseSlide;
use App\Models\MapDestinationSlide;
use App\Models\NewsItem;
use App\Models\Offer;
use App\Models\TripShowcaseSlide;
use App\Models\Visa;
use App\Models\VisaCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class PublicContentController extends Controller
{
    public function home(): View
    {
        $locale = app()->getLocale();
        $cached = Cache::remember("public:home:{$locale}", now()->addMinutes(10), function (): array {
            $heroSlides = HeroSlide::query()
                ->activeOrdered()
                ->get()
                ->map(fn (HeroSlide $s) => $s->toSliderRow())
                ->all();

            if ($heroSlides === []) {
                $heroSlides = $this->fallbackHeroSlides();
            }

            $mapDestinationItems = MapDestinationSlide::query()
                ->activeOrdered()
                ->get()
                ->map(fn (MapDestinationSlide $s) => $s->toSliderItem())
                ->all();

            if ($mapDestinationItems === []) {
                $mapDestinationItems = $this->fallbackMapDestinationItems();
            }

            $reviewItems = CustomerReview::query()
                ->activeOrdered()
                ->get()
                ->map(fn (CustomerReview $r) => $r->toSliderItem())
                ->all();

            if ($reviewItems === []) {
                $reviewItems = $this->fallbackCustomerReviewItems();
            }

            return [
                'heroSlides' => $heroSlides,
                'mapDestinationItems' => $mapDestinationItems,
                'tripShowcaseItems' => $this->tripShowcaseItems(),
                'reviewItems' => $reviewItems,
            ];
        });

        $branches = Branch::query()->activeOrdered()->get();
        $homeVisaItems = Visa::query()
            ->activeOrdered()
            ->with('category')
            ->limit(6)
            ->get();

        return view('pages.home', [
            'heroSlides' => $cached['heroSlides'],
            'branches' => $branches,
            'mapDestinationItems' => $cached['mapDestinationItems'],
            'tripShowcaseItems' => $cached['tripShowcaseItems'],
            'reviewItems' => $cached['reviewItems'],
            'homeVisaItems' => $homeVisaItems,
        ]);
    }

    public function programs(): View
    {
        $locale = app()->getLocale();
        $tripShowcaseItems = Cache::remember("public:programs:{$locale}", now()->addMinutes(10), function (): array {
            return $this->tripShowcaseItems();
        });

        return view('pages.programs', [
            'tripShowcaseItems' => $tripShowcaseItems,
        ]);
    }

    public function hotels(): View
    {
        $locale = app()->getLocale();
        $hotelShowcaseItems = Cache::remember("public:hotels:{$locale}", now()->addMinutes(10), function (): array {
            return $this->hotelShowcaseItems();
        });

        return view('pages.hotels', [
            'hotelShowcaseItems' => $hotelShowcaseItems,
        ]);
    }

    public function destinations(): View
    {
        $locale = app()->getLocale();
        $destinationShowcaseItems = Cache::remember("public:destinations:{$locale}", now()->addMinutes(10), function (): array {
            return $this->destinationPageSliderItems();
        });

        return view('pages.destinations', [
            'destinationShowcaseItems' => $destinationShowcaseItems,
        ]);
    }

    public function visas(Request $request): View
    {
        $activeCategorySlug = trim((string) $request->query('category'));
        $categories = VisaCategory::query()
            ->activeOrdered()
            ->get();

        $visasQuery = Visa::query()
            ->activeOrdered()
            ->with('category');

        if ($activeCategorySlug !== '') {
            $visasQuery->whereHas('category', function ($q) use ($activeCategorySlug): void {
                $q->where('slug', $activeCategorySlug);
            });
        }

        $visas = $visasQuery->get();

        $activeCategory = $activeCategorySlug !== ''
            ? $categories->firstWhere('slug', $activeCategorySlug)
            : null;

        return view('pages.visas', [
            'visas' => $visas,
            'categories' => $categories,
            'activeCategorySlug' => $activeCategorySlug,
            'activeCategory' => $activeCategory,
        ]);
    }

    /**
     * @return list<array<string, mixed>>
     */
    protected function fallbackMapDestinationItems(): array
    {
        if (app()->getLocale() === 'en') {
            return [
                [
                    'image' => 'https://images.unsplash.com/photo-1539037116277-4db20889f2d4?auto=format&fit=crop&w=1000&q=80',
                    'title' => 'Paris',
                    'desc' => 'Light on the streets — culture, style, and unforgettable evenings.',
                    'badge' => 'Europe',
                    'url' => localized_route('destinations'),
                ],
                [
                    'image' => 'https://images.unsplash.com/photo-1518684079-3c830d4ad804?auto=format&fit=crop&w=1000&q=80',
                    'title' => 'Dubai',
                    'desc' => 'A modern city buzz: shopping, events, and skyline energy.',
                    'badge' => 'Close by',
                    'url' => localized_route('destinations'),
                ],
                [
                    'image' => 'https://images.unsplash.com/photo-1528181304800-259b08848526?auto=format&fit=crop&w=1000&q=80',
                    'title' => 'Hong Kong',
                    'desc' => 'Towers and coastlines — a lively rhythm in every frame.',
                    'url' => localized_route('destinations'),
                ],
                [
                    'image' => 'https://images.unsplash.com/photo-1515859005217-8a4081984c5c?auto=format&fit=crop&w=1000&q=80',
                    'title' => 'London',
                    'desc' => 'A living museum where history greets a bright, busy present.',
                    'url' => localized_route('destinations'),
                ],
            ];
        }

        return [
            [
                'image' => 'https://images.unsplash.com/photo-1539037116277-4db20889f2d4?auto=format&fit=crop&w=1000&q=80',
                'title' => 'باريس',
                'desc' => 'ضوءٌ يلوّن الشوارع — ثقافة، أزياء، وأمسيات لا تُنسى.',
                'badge' => 'طابع أوروبي',
                'url' => localized_route('destinations'),
            ],
            [
                'image' => 'https://images.unsplash.com/photo-1518684079-3c830d4ad804?auto=format&fit=crop&w=1000&q=80',
                'title' => 'دبي',
                'desc' => 'مذاق المدن العصرية: تسوّق، فعاليات، وإطلالات خاطفة.',
                'badge' => 'قريب',
                'url' => localized_route('destinations'),
            ],
            [
                'image' => 'https://images.unsplash.com/photo-1528181304800-259b08848526?auto=format&fit=crop&w=1000&q=80',
                'title' => 'هونغ كونغ',
                'desc' => 'ناطحاتٌ وسواحل — إيقاعٌ مفعم في كل زاوية.',
                'url' => localized_route('destinations'),
            ],
            [
                'image' => 'https://images.unsplash.com/photo-1515859005217-8a4081984c5c?auto=format&fit=crop&w=1000&q=80',
                'title' => 'لندن',
                'desc' => 'متحفٌ مفتوح: تاريخٌ يلتقي حداثةٍ صاخبة.',
                'url' => localized_route('destinations'),
            ],
        ];
    }

    /**
     * @return list<array<string, mixed>>
     */
    protected function hotelShowcaseItems(): array
    {
        $items = HotelShowcaseSlide::query()
            ->activeOrdered()
            ->get()
            ->map(fn (HotelShowcaseSlide $s) => $s->toSliderItem())
            ->all();

        if ($items === []) {
            return $this->fallbackHotelShowcaseItems();
        }

        return $items;
    }

    /**
     * @return list<array<string, mixed>>
     */
    protected function fallbackHotelShowcaseItems(): array
    {
        $images = [
            'https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=1000&q=80',
            'https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?auto=format&fit=crop&w=1000&q=80',
            'https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?auto=format&fit=crop&w=1000&q=80',
            'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?auto=format&fit=crop&w=1000&q=80',
            'https://images.unsplash.com/photo-1571003123894-1f0594d2b5d9?auto=format&fit=crop&w=1000&q=80',
        ];
        $out = [];
        foreach (range(1, 5) as $i) {
            $badge = (string) tr('site.pages.hotels.card_'.$i.'_badge');
            $item = [
                'image' => $images[$i - 1],
                'title' => (string) tr('site.pages.hotels.card_'.$i.'_title'),
                'desc' => (string) tr('site.pages.hotels.card_'.$i.'_desc'),
                'url' => 'https://wa.me/966532352749?text='.rawurlencode((string) tr('site.pages.hotels.card_'.$i.'_wa')),
            ];
            if (trim($badge) !== '') {
                $item['badge'] = $badge;
            }
            $out[] = $item;
        }

        return $out;
    }

    /**
     * @return list<array<string, mixed>>
     */
    protected function destinationPageSliderItems(): array
    {
        $images = [
            'https://images.unsplash.com/photo-1539037116277-4db20889f2d4?auto=format&fit=crop&w=1000&q=80',
            'https://images.unsplash.com/photo-1518684079-3c830d4ad804?auto=format&fit=crop&w=1000&q=80',
            'https://images.unsplash.com/photo-1498544883517-27cb1070c6e6?auto=format&fit=crop&w=1000&q=80',
            'https://images.unsplash.com/photo-1501785888041-af3ef285b470?auto=format&fit=crop&w=1000&q=80',
            'https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?auto=format&fit=crop&w=1000&q=80',
            'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=1000&q=80',
        ];
        $out = [];
        foreach (range(1, 6) as $i) {
            $badge = (string) tr('site.pages.destinations.card_'.$i.'_badge');
            $item = [
                'image' => $images[$i - 1],
                'title' => (string) tr('site.pages.destinations.card_'.$i.'_title'),
                'desc' => (string) tr('site.pages.destinations.card_'.$i.'_desc'),
                'url' => 'https://wa.me/966532352749?text='.rawurlencode((string) tr('site.pages.destinations.card_'.$i.'_wa')),
            ];
            if (trim($badge) !== '') {
                $item['badge'] = $badge;
            }
            $out[] = $item;
        }

        return $out;
    }

    /**
     * @return list<array<string, mixed>>
     */
    protected function tripShowcaseItems(): array
    {
        $items = TripShowcaseSlide::query()
            ->activeOrdered()
            ->get()
            ->map(fn (TripShowcaseSlide $s) => $s->toSliderItem())
            ->all();

        if ($items === []) {
            return $this->fallbackTripShowcaseItems();
        }

        return $items;
    }

    /**
     * @return list<array<string, mixed>>
     */
    protected function fallbackTripShowcaseItems(): array
    {
        if (app()->getLocale() === 'en') {
            return [
                [
                    'image' => 'https://images.unsplash.com/photo-1436491865332-7a61a109cc05?auto=format&fit=crop&w=1000&q=80',
                    'title' => 'Short getaway package',
                    'desc' => 'Flights, stay, and a warm welcome — a fit for your next break.',
                    'badge' => '4–6 nights',
                    'url' => localized_route('programs'),
                ],
                [
                    'image' => 'https://images.unsplash.com/photo-1488646953014-85cb44e25828?auto=format&fit=crop&w=1000&q=80',
                    'title' => 'Discovery day',
                    'desc' => 'A day for walks and the local market — without the rush.',
                    'url' => localized_route('programs'),
                ],
                [
                    'image' => 'https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?auto=format&fit=crop&w=1000&q=80',
                    'title' => 'Clear-sea holiday',
                    'desc' => 'A view that colours the light — where water meets the sky.',
                    'badge' => 'Family',
                    'url' => localized_route('programs'),
                ],
                [
                    'image' => 'https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?auto=format&fit=crop&w=1000&q=80',
                    'title' => 'Mountain escape',
                    'desc' => 'Breathe the outdoors — hand-picked paths from our team.',
                    'url' => localized_route('programs'),
                ],
            ];
        }

        return [
            [
                'image' => 'https://images.unsplash.com/photo-1436491865332-7a61a109cc05?auto=format&fit=crop&w=1000&q=80',
                'title' => 'باقة عطلة مُختصرة',
                'desc' => 'طيران + إقامة + تحيّة استقبال — مثالية لرحلتك القادمة.',
                'badge' => '٤–٦ ليالٍ',
                'url' => localized_route('programs'),
            ],
            [
                'image' => 'https://images.unsplash.com/photo-1488646953014-85cb44e25828?auto=format&fit=crop&w=1000&q=80',
                'title' => 'رحلة استكشاف',
                'desc' => 'يومٌ مفتوح للمشي والسوق المحلي — دون تعبٍ مُحدِق.',
                'url' => localized_route('programs'),
            ],
            [
                'image' => 'https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?auto=format&fit=crop&w=1000&q=80',
                'title' => 'عطلة بحرٍ صافٍ',
                'desc' => 'منظرٌ يلوّن البريق — ماءٌ يلامس السماء.',
                'badge' => 'عائلية',
                'url' => localized_route('programs'),
            ],
            [
                'image' => 'https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?auto=format&fit=crop&w=1000&q=80',
                'title' => 'رحلة جبلية',
                'desc' => 'تنفّس طبيعةً — مساراتٌ مُختارة بعناية فريقنا.',
                'url' => localized_route('programs'),
            ],
        ];
    }

    /**
     * @return list<array<string, mixed>>
     */
    protected function fallbackCustomerReviewItems(): array
    {
        if (app()->getLocale() === 'en') {
            return [
                [
                    'type' => 'review',
                    'quote' => 'They were fully transparent, and the planning beat my expectations — from flights to the hotel choice.',
                    'name' => 'Nora',
                    'from' => 'Tabuk',
                    'initial' => 'N',
                    'rating' => 5,
                ],
                [
                    'type' => 'review',
                    'quote' => 'WhatsApp support saved us a lot of time; every question was answered fast.',
                    'name' => 'Majed',
                    'from' => 'Jeddah',
                    'initial' => 'M',
                    'rating' => 5,
                ],
                [
                    'type' => 'review',
                    'quote' => 'For the first time a travel agency made “clarity” feel real: neat details, zero clutter.',
                    'name' => 'Sara',
                    'from' => 'Riyadh',
                    'initial' => 'S',
                    'rating' => 5,
                ],
                [
                    'type' => 'review',
                    'quote' => 'They proposed a plan that fit our budget — and the trip was comfortable in every way.',
                    'name' => 'Abdullah',
                    'from' => 'Tabuk',
                    'initial' => 'A',
                    'rating' => 4,
                ],
            ];
        }

        return [
            [
                'type' => 'review',
                'quote' => 'تعاملوا معنا بشفافية تامة، وكان التنظيم أقوى من توقعي — بدايةٌ من الطيران وصولاً لاختيار الفندق.',
                'name' => 'نورا',
                'from' => 'تبوك',
                'initial' => 'ن',
                'rating' => 5,
            ],
            [
                'type' => 'review',
                'quote' => 'الدعم على الواتساب خلّصنا وقت كثير، وكل استفسار انحل بسرعة.',
                'name' => 'ماجد',
                'from' => 'جدة',
                'initial' => 'م',
                'rating' => 5,
            ],
            [
                'type' => 'review',
                'quote' => 'لأول مرة أشعر إن وكالة سفر تفهم “اللمعان” بمعنى آخر: تفاصيل مُرتّبة من غير تعقيد.',
                'name' => 'سارة',
                'from' => 'الرياض',
                'initial' => 'س',
                'rating' => 5,
            ],
            [
                'type' => 'review',
                'quote' => 'نِدّلنا على باقة تناسب ميزانيتنا، والحمد لله سفرتي كانت مريحة بكل المقاييس.',
                'name' => 'عبدالله',
                'from' => 'تبوك',
                'initial' => 'ع',
                'rating' => 4,
            ],
        ];
    }

    /**
     * @return list<array<string, mixed>>
     */
    protected function fallbackHeroSlides(): array
    {
        if (app()->getLocale() === 'en') {
            return $this->fallbackHeroSlidesEn();
        }

        return $this->fallbackHeroSlidesAr();
    }

    /**
     * @return list<array<string, mixed>>
     */
    protected function fallbackHeroSlidesAr(): array
    {
        return [
            [
                'image' => 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=2000&q=80',
                'image_label' => 'شاطئ بضوء ذهبي',
                'kicker' => 'بريق يضيء كل رحلة',
                'title' => 'سافر بثقة.. سافر مع البريق',
                'lead' => 'نجمع لك حلول سفر متكاملة من حجوزات طيران ودعم الفيزا إلى باقات العطلات، مع دعم فني ٢٤/٧ — وكالة مرخّصة وعضو IATA.',
                'primary_href' => 'https://wa.me/966532352749?text=%D8%A3%D8%B1%D8%BA%D8%A8%20%D8%AD%D8%AC%D8%B2%20%D8%B1%D8%AD%D9%84%D8%AA%D9%8A',
                'primary_label' => 'احجز رحلتك الآن',
                'secondary_href' => localized_route('destinations'),
                'secondary_label' => 'استكشف الوجهات',
            ],
            [
                'image' => 'https://images.unsplash.com/photo-1436491865332-7a61a109cc05?auto=format&fit=crop&w=2000&q=80',
                'image_label' => 'غروب وطائرة',
                'kicker' => 'نظامٌ يلمّع التفاصيل',
                'title' => 'رحلتك تبدأ قبل الإقلاع',
                'lead' => 'ننسّق لك الجدول: تأشيرات، تأمينٌ سفري، وخيارات إقامة تلائم ميزانيتك — مع متابعة حتى عودتك بسلام.',
                'primary_href' => localized_route('programs'),
                'primary_label' => 'البرامج السياحية',
                'secondary_href' => localized_route('hotels'),
                'secondary_label' => 'تصفّح الفنادق',
            ],
            [
                'image' => 'https://images.unsplash.com/photo-1488646953014-85cb44e25828?auto=format&fit=crop&w=2000&q=80',
                'image_label' => 'ممر سفر',
                'kicker' => 'وجهاتٌ بانتظار برنامجك',
                'title' => 'عالمٌ واسع.. وخطوةٌ بخطوة معنا',
                'lead' => 'من المدن الصاخبة إلى الشواطئ الهادئة — نرشّح لك الخيار ونرافقك في الاختيار بلا تشتيت.',
                'primary_href' => localized_route('destinations'),
                'primary_label' => 'أفضل الوجهات',
                'secondary_href' => site_whatsapp_url('أرغب في الاستفسار عن خيارات السفر'),
                'secondary_label' => 'واتساب',
            ],
        ];
    }

    /**
     * @return list<array<string, mixed>>
     */
    protected function fallbackHeroSlidesEn(): array
    {
        return [
            [
                'image' => 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=2000&q=80',
                'image_label' => 'Beach at golden hour',
                'kicker' => 'A glow on every trip',
                'title' => 'Travel with confidence.. travel with Al Bareeq',
                'lead' => 'We offer end-to-end travel solutions — flights, visas, holiday packages, and 24/7 support — a licensed agency and an IATA member.',
                'primary_href' => 'https://wa.me/966532352749?text=I%20would%20like%20to%20book%20a%20trip',
                'primary_label' => 'Book your trip',
                'secondary_href' => localized_route('destinations'),
                'secondary_label' => 'Explore destinations',
            ],
            [
                'image' => 'https://images.unsplash.com/photo-1436491865332-7a61a109cc05?auto=format&fit=crop&w=2000&q=80',
                'image_label' => 'Sunset and aircraft',
                'kicker' => 'We polish the details',
                'title' => 'Your trip starts before take-off',
                'lead' => 'We coordinate visas, travel insurance, and stays that match your budget — with support until you are home safe.',
                'primary_href' => localized_route('programs'),
                'primary_label' => 'Travel programs',
                'secondary_href' => localized_route('hotels'),
                'secondary_label' => 'Browse hotels',
            ],
            [
                'image' => 'https://images.unsplash.com/photo-1488646953014-85cb44e25828?auto=format&fit=crop&w=2000&q=80',
                'image_label' => 'Airport walk',
                'kicker' => 'Destinations waiting for your plan',
                'title' => 'A wider world — step by step with us',
                'lead' => 'From lively cities to quiet coasts — we shortlist and guide your choices without the noise.',
                'primary_href' => localized_route('destinations'),
                'primary_label' => 'Top destinations',
                'secondary_href' => site_whatsapp_url('I would like to ask about travel options'),
                'secondary_label' => 'WhatsApp',
            ],
        ];
    }

    public function blogIndex(): View
    {
        $locale = app()->getLocale();
        $posts = Cache::remember("public:blog-index:{$locale}", now()->addMinutes(10), function () {
            return BlogPost::query()
                ->published()
                ->orderByDesc('published_at')
                ->get();
        });

        return view('pages.blog-index', [
            'posts' => $posts,
        ]);
    }

    public function blogShow(string $slug): View
    {
        $locale = app()->getLocale();
        $post = Cache::remember("public:blog-show:{$locale}:{$slug}", now()->addMinutes(10), function () use ($slug) {
            return BlogPost::query()
                ->published()
                ->where('slug', $slug)
                ->firstOrFail();
        });

        return view('pages.blog-show', [
            'post' => $post,
        ]);
    }

    public function newsIndex(): View
    {
        $locale = app()->getLocale();
        $items = Cache::remember("public:news-index:{$locale}", now()->addMinutes(10), function () {
            return NewsItem::query()
                ->published()
                ->orderByDesc('published_at')
                ->get();
        });

        return view('pages.news-index', [
            'items' => $items,
        ]);
    }

    public function newsShow(string $slug): View
    {
        $locale = app()->getLocale();
        $item = Cache::remember("public:news-show:{$locale}:{$slug}", now()->addMinutes(10), function () use ($slug) {
            return NewsItem::query()
                ->published()
                ->where('slug', $slug)
                ->firstOrFail();
        });

        return view('pages.news-show', [
            'item' => $item,
        ]);
    }

    public function offersPage(): View
    {
        $locale = app()->getLocale();
        $offers = Cache::remember("public:offers:{$locale}", now()->addMinutes(10), function () {
            return Offer::query()->active()->get();
        });

        return view('pages.offers', [
            'offers' => $offers,
        ]);
    }
}
