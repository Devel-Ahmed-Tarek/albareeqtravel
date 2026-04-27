<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use App\Models\Branch;
use App\Models\HeroSlide;
use App\Models\MapDestinationSlide;
use App\Models\NewsItem;
use App\Models\TripShowcaseSlide;
use App\Models\CustomerReview;
use App\Models\HotelShowcaseSlide;
use App\Models\Offer;
use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class SiteContentSeeder extends Seeder
{
    public function run(): void
    {
        User::query()->updateOrCreate(
            ['email' => 'admin@albareeq.local'],
            [
                'name' => 'مدير الموقع',
                'password' => Hash::make(config('app.admin_password', 'password')),
                'is_admin' => true,
            ],
        );

        SiteSetting::query()->updateOrCreate(
            ['id' => 1],
            [
                'logo_path' => null,
                'favicon_path' => null,
                'site_name_ar' => 'البريق للسفر والسياحة | AlBareeq Travel',
                'site_name_en' => 'AlBareeq Travel | البريق',
                'default_meta_ar' => 'شركة البريق للسفر والسياحة — حلول سفر متكاملة، حجوزات، فيزا، باقات ودعم ٢٤/٧. عضو IATA.',
                'default_meta_en' => 'AlBareeq Travel — full travel services, flights, visas, packages, and 24/7 support. IATA member.',
                'phone_primary' => '+966 53 235 2749',
                'phone_secondary' => '+966 53 065 6092',
                'whatsapp_number' => '966532352749',
                'contact_email' => null,
            ],
        );

        foreach ([0, 1, 2] as $n) {
            HeroSlide::query()->updateOrCreate(
                ['sort_order' => $n],
                match ($n) {
                    0 => [
                        'sort_order' => 0,
                        'is_active' => true,
                        'image' => 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=2000&q=80',
                        'image_label_ar' => 'شاطئ بضوء ذهبي',
                        'image_label_en' => 'Beach at golden hour',
                        'kicker_ar' => 'بريق يضيء كل رحلة',
                        'kicker_en' => 'A glow on every trip',
                        'title_ar' => 'سافر بثقة.. سافر مع البريق',
                        'title_en' => 'Travel with confidence.. travel with Al Bareeq',
                        'lead_ar' => 'نجمع لك حلول سفر متكاملة من حجوزات طيران ودعم الفيزا إلى باقات العطلات، مع دعم فني ٢٤/٧ — وكالة مرخّصة وعضو IATA.',
                        'lead_en' => 'We offer end-to-end travel solutions — flights, visas, holiday packages, and 24/7 support — a licensed agency and an IATA member.',
                        'primary_route' => null,
                        'primary_href_ar' => 'https://wa.me/966532352749?text=%D8%A3%D8%B1%D8%BA%D8%A8%20%D8%AD%D8%AC%D8%B2%20%D8%B1%D8%AD%D9%84%D8%AA%D9%8A',
                        'primary_href_en' => 'https://wa.me/966532352749?text=I%20would%20like%20to%20book%20a%20trip',
                        'primary_label_ar' => 'احجز رحلتك الآن',
                        'primary_label_en' => 'Book your trip',
                        'secondary_route' => 'destinations',
                        'secondary_href_ar' => null,
                        'secondary_href_en' => null,
                        'secondary_label_ar' => 'استكشف الوجهات',
                        'secondary_label_en' => 'Explore destinations',
                    ],
                    1 => [
                        'sort_order' => 1,
                        'is_active' => true,
                        'image' => 'https://images.unsplash.com/photo-1436491865332-7a61a109cc05?auto=format&fit=crop&w=2000&q=80',
                        'image_label_ar' => 'غروب وطائرة',
                        'image_label_en' => 'Sunset and aircraft',
                        'kicker_ar' => 'نظامٌ يلمّع التفاصيل',
                        'kicker_en' => 'We polish the details',
                        'title_ar' => 'رحلتك تبدأ قبل الإقلاع',
                        'title_en' => 'Your trip starts before take-off',
                        'lead_ar' => 'ننسّق لك الجدول: تأشيرات، تأمينٌ سفري، وخيارات إقامة تلائم ميزانيتك — مع متابعة حتى عودتك بسلام.',
                        'lead_en' => 'We coordinate visas, travel insurance, and stays that match your budget — with support until you are home safe.',
                        'primary_route' => 'programs',
                        'primary_href_ar' => null,
                        'primary_href_en' => null,
                        'primary_label_ar' => 'البرامج السياحية',
                        'primary_label_en' => 'Travel programs',
                        'secondary_route' => 'hotels',
                        'secondary_href_ar' => null,
                        'secondary_href_en' => null,
                        'secondary_label_ar' => 'تصفّح الفنادق',
                        'secondary_label_en' => 'Browse hotels',
                    ],
                    2 => [
                        'sort_order' => 2,
                        'is_active' => true,
                        'image' => 'https://images.unsplash.com/photo-1488646953014-85cb44e25828?auto=format&fit=crop&w=2000&q=80',
                        'image_label_ar' => 'ممر سفر',
                        'image_label_en' => 'Airport walk',
                        'kicker_ar' => 'وجهاتٌ بانتظار برنامجك',
                        'kicker_en' => 'Destinations waiting for your plan',
                        'title_ar' => 'عالمٌ واسع.. وخطوةٌ بخطوة معنا',
                        'title_en' => 'A wider world — step by step with us',
                        'lead_ar' => 'من المدن الصاخبة إلى الشواطئ الهادئة — نرشّح لك الخيار ونرافقك في الاختيار بلا تشتيت.',
                        'lead_en' => 'From lively cities to quiet coasts — we shortlist and guide your choices without the noise.',
                        'primary_route' => 'destinations',
                        'primary_href_ar' => null,
                        'primary_href_en' => null,
                        'primary_label_ar' => 'أفضل الوجهات',
                        'primary_label_en' => 'Top destinations',
                        'secondary_route' => 'contact',
                        'secondary_href_ar' => null,
                        'secondary_href_en' => null,
                        'secondary_label_ar' => 'تواصل معنا',
                        'secondary_label_en' => 'Contact us',
                    ],
                }
            );
        }

        foreach ([0, 1, 2] as $n) {
            Branch::query()->updateOrCreate(
                ['sort_order' => $n],
                match ($n) {
                    0 => [
                        'sort_order' => 0,
                        'is_active' => true,
                        'title_ar' => 'تبوك — الروضة',
                        'title_en' => 'Tabuk — Al Rawdah',
                        'address_ar' => 'رقم المبنى ٧٢٧٢، حي الروضة، طريق الملك عبدالعزيز، تبوك ٤٧٧١١',
                        'address_en' => 'Building 7272, Al Rawdah, King Abdulaziz Road, Tabuk 47711',
                        'phone' => '+966 55 608 7732',
                    ],
                    1 => [
                        'sort_order' => 1,
                        'is_active' => true,
                        'title_ar' => 'تبوك — العليا',
                        'title_en' => 'Tabuk — Al Olaya',
                        'address_ar' => 'طريق الأمير يزيد بن عبدالله، حي العليا، تبوك ٤٧٩١١',
                        'address_en' => 'Prince Yazid bin Abdullah Road, Al Olaya, Tabuk 47911',
                        'phone' => '+966 53 757 7987',
                    ],
                    2 => [
                        'sort_order' => 2,
                        'is_active' => true,
                        'title_ar' => 'جدة — الربوة',
                        'title_en' => 'Jeddah — Al Rabwah',
                        'address_ar' => 'تواصل مباشر عبر أرقامنا — نساعدك بكل استفسار بخصوص الوجهة.',
                        'address_en' => 'Call us for directions and on-site help — we will guide you in detail.',
                        'phone' => '+966 53 065 6092',
                    ],
                }
            );
        }

        foreach ([0, 1, 2, 3] as $n) {
            MapDestinationSlide::query()->updateOrCreate(
                ['sort_order' => $n],
                match ($n) {
                    0 => [
                        'sort_order' => 0,
                        'is_active' => true,
                        'image' => 'https://images.unsplash.com/photo-1539037116277-4db20889f2d4?auto=format&fit=crop&w=1000&q=80',
                        'image_path' => null,
                        'title_ar' => 'باريس',
                        'title_en' => 'Paris',
                        'desc_ar' => 'ضوءٌ يلوّن الشوارع — ثقافة، أزياء، وأمسيات لا تُنسى.',
                        'desc_en' => 'Light on the streets — culture, style, and unforgettable evenings.',
                        'badge_ar' => 'طابع أوروبي',
                        'badge_en' => 'Europe',
                        'link_route' => 'destinations',
                        'link_href_ar' => null,
                        'link_href_en' => null,
                    ],
                    1 => [
                        'sort_order' => 1,
                        'is_active' => true,
                        'image' => 'https://images.unsplash.com/photo-1518684079-3c830d4ad804?auto=format&fit=crop&w=1000&q=80',
                        'image_path' => null,
                        'title_ar' => 'دبي',
                        'title_en' => 'Dubai',
                        'desc_ar' => 'مذاق المدن العصرية: تسوّق، فعاليات، وإطلالات خاطفة.',
                        'desc_en' => 'A modern city buzz: shopping, events, and skyline energy.',
                        'badge_ar' => 'قريب',
                        'badge_en' => 'Close by',
                        'link_route' => 'destinations',
                        'link_href_ar' => null,
                        'link_href_en' => null,
                    ],
                    2 => [
                        'sort_order' => 2,
                        'is_active' => true,
                        'image' => 'https://images.unsplash.com/photo-1528181304800-259b08848526?auto=format&fit=crop&w=1000&q=80',
                        'image_path' => null,
                        'title_ar' => 'هونغ كونغ',
                        'title_en' => 'Hong Kong',
                        'desc_ar' => 'ناطحاتٌ وسواحل — إيقاعٌ مفعم في كل زاوية.',
                        'desc_en' => 'Towers and coastlines — a lively rhythm in every frame.',
                        'badge_ar' => null,
                        'badge_en' => null,
                        'link_route' => 'destinations',
                        'link_href_ar' => null,
                        'link_href_en' => null,
                    ],
                    3 => [
                        'sort_order' => 3,
                        'is_active' => true,
                        'image' => 'https://images.unsplash.com/photo-1515859005217-8a4081984c5c?auto=format&fit=crop&w=1000&q=80',
                        'image_path' => null,
                        'title_ar' => 'لندن',
                        'title_en' => 'London',
                        'desc_ar' => 'متحفٌ مفتوح: تاريخٌ يلتقي حداثةٍ صاخبة.',
                        'desc_en' => 'A living museum where history greets a bright, busy present.',
                        'badge_ar' => null,
                        'badge_en' => null,
                        'link_route' => 'destinations',
                        'link_href_ar' => null,
                        'link_href_en' => null,
                    ],
                }
            );
        }

        foreach ([0, 1, 2, 3] as $n) {
            TripShowcaseSlide::query()->updateOrCreate(
                ['sort_order' => $n],
                match ($n) {
                    0 => [
                        'sort_order' => 0,
                        'is_active' => true,
                        'image' => 'https://images.unsplash.com/photo-1436491865332-7a61a109cc05?auto=format&fit=crop&w=1000&q=80',
                        'image_path' => null,
                        'title_ar' => 'باقة عطلة مُختصرة',
                        'title_en' => 'Short getaway package',
                        'desc_ar' => 'طيران + إقامة + تحيّة استقبال — مثالية لرحلتك القادمة.',
                        'desc_en' => 'Flights, stay, and a warm welcome — a fit for your next break.',
                        'badge_ar' => '٤–٦ ليالٍ',
                        'badge_en' => '4–6 nights',
                        'link_route' => 'programs',
                        'link_href_ar' => null,
                        'link_href_en' => null,
                    ],
                    1 => [
                        'sort_order' => 1,
                        'is_active' => true,
                        'image' => 'https://images.unsplash.com/photo-1488646953014-85cb44e25828?auto=format&fit=crop&w=1000&q=80',
                        'image_path' => null,
                        'title_ar' => 'رحلة استكشاف',
                        'title_en' => 'Discovery day',
                        'desc_ar' => 'يومٌ مفتوح للمشي والسوق المحلي — دون تعبٍ مُحدِق.',
                        'desc_en' => 'A day for walks and the local market — without the rush.',
                        'badge_ar' => null,
                        'badge_en' => null,
                        'link_route' => 'programs',
                        'link_href_ar' => null,
                        'link_href_en' => null,
                    ],
                    2 => [
                        'sort_order' => 2,
                        'is_active' => true,
                        'image' => 'https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?auto=format&fit=crop&w=1000&q=80',
                        'image_path' => null,
                        'title_ar' => 'عطلة بحرٍ صافٍ',
                        'title_en' => 'Clear-sea holiday',
                        'desc_ar' => 'منظرٌ يلوّن البريق — ماءٌ يلامس السماء.',
                        'desc_en' => 'A view that colours the light — where water meets the sky.',
                        'badge_ar' => 'عائلية',
                        'badge_en' => 'Family',
                        'link_route' => 'programs',
                        'link_href_ar' => null,
                        'link_href_en' => null,
                    ],
                    3 => [
                        'sort_order' => 3,
                        'is_active' => true,
                        'image' => 'https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?auto=format&fit=crop&w=1000&q=80',
                        'image_path' => null,
                        'title_ar' => 'رحلة جبلية',
                        'title_en' => 'Mountain escape',
                        'desc_ar' => 'تنفّس طبيعةً — مساراتٌ مُختارة بعناية فريقنا.',
                        'desc_en' => 'Breathe the outdoors — hand-picked paths from our team.',
                        'badge_ar' => null,
                        'badge_en' => null,
                        'link_route' => 'programs',
                        'link_href_ar' => null,
                        'link_href_en' => null,
                    ],
                }
            );
        }

        foreach ([0, 1, 2, 3] as $n) {
            CustomerReview::query()->updateOrCreate(
                ['sort_order' => $n],
                match ($n) {
                    0 => [
                        'sort_order' => 0,
                        'is_active' => true,
                        'rating' => 5,
                        'quote_ar' => 'تعاملوا معنا بشفافية تامة، وكان التنظيم أقوى من توقعي — بدايةٌ من الطيران وصولاً لاختيار الفندق.',
                        'quote_en' => 'They were fully transparent, and the planning beat my expectations — from flights to the hotel choice.',
                        'name_ar' => 'نورا',
                        'name_en' => 'Nora',
                        'from_city_ar' => 'تبوك',
                        'from_city_en' => 'Tabuk',
                    ],
                    1 => [
                        'sort_order' => 1,
                        'is_active' => true,
                        'rating' => 5,
                        'quote_ar' => 'الدعم على الواتساب خلّصنا وقت كثير، وكل استفسار انحل بسرعة.',
                        'quote_en' => 'WhatsApp support saved us a lot of time; every question was answered fast.',
                        'name_ar' => 'ماجد',
                        'name_en' => 'Majed',
                        'from_city_ar' => 'جدة',
                        'from_city_en' => 'Jeddah',
                    ],
                    2 => [
                        'sort_order' => 2,
                        'is_active' => true,
                        'rating' => 5,
                        'quote_ar' => 'لأول مرة أشعر إن وكالة سفر تفهم “اللمعان” بمعنى آخر: تفاصيل مُرتّبة من غير تعقيد.',
                        'quote_en' => 'For the first time a travel agency made “clarity” feel real: neat details, zero clutter.',
                        'name_ar' => 'سارة',
                        'name_en' => 'Sara',
                        'from_city_ar' => 'الرياض',
                        'from_city_en' => 'Riyadh',
                    ],
                    3 => [
                        'sort_order' => 3,
                        'is_active' => true,
                        'rating' => 4,
                        'quote_ar' => 'نِدّلنا على باقة تناسب ميزانيتنا، والحمد لله سفرتي كانت مريحة بكل المقاييس.',
                        'quote_en' => 'They proposed a plan that fit our budget — and the trip was comfortable in every way.',
                        'name_ar' => 'عبدالله',
                        'name_en' => 'Abdullah',
                        'from_city_ar' => 'تبوك',
                        'from_city_en' => 'Tabuk',
                    ],
                }
            );
        }

        foreach ([0, 1, 2, 3, 4] as $n) {
            HotelShowcaseSlide::query()->updateOrCreate(
                ['sort_order' => $n],
                match ($n) {
                    0 => [
                        'sort_order' => 0,
                        'is_active' => true,
                        'image' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=1000&q=80',
                        'image_path' => null,
                        'title_ar' => 'فنادق فئة أولى',
                        'title_en' => 'First-class hotels',
                        'desc_ar' => 'لمن يطلب جودة أعلى في الموقع، الخدمة، والراحة.',
                        'desc_en' => 'For guests who want more: location, service, and comfort.',
                        'badge_ar' => '5★',
                        'badge_en' => '5★',
                        'link_route' => null,
                        'link_href_ar' => null,
                        'link_href_en' => null,
                        'wa_prefill_ar' => 'أرغب بعرض فنادق فئة أولى لوجهتي',
                        'wa_prefill_en' => 'I would like 5-star hotel options for my destination',
                    ],
                    1 => [
                        'sort_order' => 1,
                        'is_active' => true,
                        'image' => 'https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?auto=format&fit=crop&w=1000&q=80',
                        'image_path' => null,
                        'title_ar' => 'إقامة متوازنة',
                        'title_en' => 'Balanced stays',
                        'desc_ar' => 'راحة ممتازة، سعرٌ مُحكم، وقربٌ من أهم المعالم.',
                        'desc_en' => 'Strong value, a fair price, and proximity to the highlights.',
                        'badge_ar' => 'قيمة',
                        'badge_en' => 'Value',
                        'link_route' => null,
                        'link_href_ar' => null,
                        'link_href_en' => null,
                        'wa_prefill_ar' => 'أرغب بعرض فنادق بإقامة متوازنة',
                        'wa_prefill_en' => 'I would like balanced mid-range hotel options',
                    ],
                    2 => [
                        'sort_order' => 2,
                        'is_active' => true,
                        'image' => 'https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?auto=format&fit=crop&w=1000&q=80',
                        'image_path' => null,
                        'title_ar' => 'رحلات عائلية',
                        'title_en' => 'Family trips',
                        'desc_ar' => 'غُرفٌ مترابطة وخدماتٌ تُناسب الأطفال والراحة المشتركة.',
                        'desc_en' => 'Connecting rooms and services that suit kids and shared downtime.',
                        'badge_ar' => 'عائلية',
                        'badge_en' => 'Family',
                        'link_route' => null,
                        'link_href_ar' => null,
                        'link_href_en' => null,
                        'wa_prefill_ar' => 'أرغب بعرض فنادق مناسبة لعطلة عائلية',
                        'wa_prefill_en' => 'I would like family-friendly hotel options',
                    ],
                    3 => [
                        'sort_order' => 3,
                        'is_active' => true,
                        'image' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?auto=format&fit=crop&w=1000&q=80',
                        'image_path' => null,
                        'title_ar' => 'أعمال واجتماعات',
                        'title_en' => 'Business travel',
                        'desc_ar' => 'قربٌ من مراكز الأعمال، مكتبٌ في الغرفة عند الحاجة.',
                        'desc_en' => 'Near business hubs, in-room workspace when you need it.',
                        'badge_ar' => 'Business',
                        'badge_en' => 'Business',
                        'link_route' => null,
                        'link_href_ar' => null,
                        'link_href_en' => null,
                        'wa_prefill_ar' => 'أرغب بعرض فنادق مناسبة لسفر أعمال',
                        'wa_prefill_en' => 'I would like business-travel hotel options',
                    ],
                    4 => [
                        'sort_order' => 4,
                        'is_active' => true,
                        'image' => 'https://images.unsplash.com/photo-1571003123894-1f0594d2b5d9?auto=format&fit=crop&w=1000&q=80',
                        'image_path' => null,
                        'title_ar' => 'منتجعات وشاطئ',
                        'title_en' => 'Resorts & beach',
                        'desc_ar' => 'لحظة استرخاء: إفطارٌ هادئ وإطلالة تبعث على الراحة.',
                        'desc_en' => 'A relaxing moment: a calm breakfast and a view that eases the mind.',
                        'badge_ar' => 'Spa & شاطئ',
                        'badge_en' => 'Spa & beach',
                        'link_route' => null,
                        'link_href_ar' => null,
                        'link_href_en' => null,
                        'wa_prefill_ar' => 'أرغب بعرض منتجعات أو فنادق شاطئية',
                        'wa_prefill_en' => 'I would like resort or beach hotel options',
                    ],
                }
            );
        }

        $d1 = Carbon::now()->subDays(8);
        $d2 = Carbon::now()->subDays(25);
        $d3 = Carbon::now()->subWeeks(6);

        BlogPost::query()->updateOrCreate(
            ['slug' => 'tips-smart-packing'],
            [
                'image' => 'https://images.unsplash.com/photo-1565026057447-bc90a3dceb87?auto=format&fit=crop&w=1200&q=80',
                'is_published' => true,
                'published_at' => $d1,
                'title_ar' => 'تجهيز حقيبة ذكية قبل السفر',
                'title_en' => 'Packing a smarter bag before you fly',
                'excerpt_ar' => 'قائمة مختصرة تضبط وزن الحقيبة وتخفف التوتر في المطار — دون أن تنسى الأسماء المهمة.',
                'excerpt_en' => 'A short list to save weight, time, and last-minute stress at the airport.',
                'body_ar' => '<p class="mb-4">السفر يبدأ من الحقيبة: ابدأ بقائمة لمدة الرحلة، وافصل «الثابت» مثل الأدوية والوثائق عن «اليومي» مثل الملابس القابلة للطبقات.</p>'
                    .'<p>فريقنا يساعدك لترشيح ما يناسب وجهتك.</p>',
                'body_en' => '<p class="mb-4">Start with a list for the length of your stay. Keep essentials (medications, documents) easy to reach.</p>'
                    .'<p>We can help you match your packing list to your route and season.</p>',
            ],
        );

        BlogPost::query()->updateOrCreate(
            ['slug' => 'visa-readiness'],
            [
                'image' => 'https://images.unsplash.com/photo-1436491865332-7a61a109cc05?auto=format&fit=crop&w=1200&q=80',
                'is_published' => true,
                'published_at' => $d2,
                'title_ar' => 'جاهزية التأشيرة: ماذا تُجهّز قبل الموعد؟',
                'title_en' => 'Visa prep: what to have ready',
                'excerpt_ar' => 'مستندات وملفات مرتبة قبل التقديم.',
                'excerpt_en' => 'Documents, timelines, and a calm checklist.',
                'body_ar' => '<p>تختلف المطلوبات حسب الوجهة. ننصح بنسخ رقمية واضحة بجانب الأصل.</p>',
                'body_en' => '<p>Requirements differ by country. Keep digital and paper copies in one folder.</p>',
            ],
        );

        BlogPost::query()->updateOrCreate(
            ['slug' => 'family-timezones'],
            [
                'image' => 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?auto=format&fit=crop&w=1200&q=80',
                'is_published' => true,
                'published_at' => $d3,
                'title_ar' => 'رحلة عائلية: إدارة الفارق الزمني',
                'title_en' => 'Family trips and jet lag',
                'excerpt_ar' => 'نصائح بسيطة لأيام أخف بعد الرحيل.',
                'excerpt_en' => 'Gentle days after long flights, especially with kids.',
                'body_ar' => '<p>امنح عائلتك يومين مرنين للجداول.</p>',
                'body_en' => '<p>Build buffer time into the first 48 hours after you land.</p>',
            ],
        );

        NewsItem::query()->updateOrCreate(
            ['slug' => 'iata-continued'],
            [
                'image' => 'https://images.unsplash.com/photo-1454496522488-7a8e488e8606?auto=format&fit=crop&w=1200&q=80',
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(10),
                'title_ar' => 'تجديد الالتزام بمعايير IATA',
                'title_en' => 'IATA standards at AlBareeq',
                'excerpt_ar' => 'نستمر في تطبيق معايير مبيعات وخدمات السفر.',
                'excerpt_en' => 'We continue to follow global travel retail standards for clearer service.',
                'body_ar' => '<p>شركة البريق للسفر والسياحة تضع خلف كل حجز فريق متابعة.</p><p>للاستفسار تواصل عبر <a class="text-sky-300 underline" href="https://wa.me/966532352749">واتساب</a>.</p>',
                'body_en' => '<p>Our team works with partners under IATA-aligned processes.</p><p>See <a class="text-sky-300 underline" href="https://wa.me/966532352749">WhatsApp</a> for help.</p>',
            ],
        );

        NewsItem::query()->updateOrCreate(
            ['slug' => 'new-hours-tabuk'],
            [
                'image' => 'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?auto=format&fit=crop&w=1200&q=80',
                'is_published' => true,
                'published_at' => Carbon::now()->subWeeks(3),
                'title_ar' => 'تبوك: مواعيد موسعة بفرع الروضة',
                'title_en' => 'Tabuk — extended hours (Al Rawdah)',
                'excerpt_ar' => 'لاستيعاب أوقات الذروة تم تمديد الاستقبال.',
                'excerpt_en' => 'We extended reception at Al Rawdah on selected weekends — confirm by phone.',
                'body_ar' => '<p>راجع أرقام الفروع المحدثة عبر <a class="text-sky-300 underline" href="https://wa.me/966532352749">واتساب</a>.</p>',
                'body_en' => '<p>Call the branch for the same-day schedule as your visit.</p>',
            ],
        );

        NewsItem::query()->updateOrCreate(
            ['slug' => 'ramadan-trips'],
            [
                'image' => 'https://images.unsplash.com/photo-1500534314209-a25edd2f429a?auto=format&fit=crop&w=1200&q=80',
                'is_published' => true,
                'published_at' => Carbon::now()->subMonth(),
                'title_ar' => 'باقات عطلات عائلية: تحديث موسمي',
                'title_en' => 'Family holiday offers — new season',
                'excerpt_ar' => 'مقاعد مُنظّمة على عدة وجهات.',
                'excerpt_en' => 'New bundles with flexible school-holiday windows.',
                'body_ar' => '<p>راسلنا واتساب لعرضٍ يناسب تاريخك.</p>',
                'body_en' => '<p>WhatsApp us to hold seats for your family dates.</p>',
            ],
        );

        $offers = [
            [
                'title_ar' => 'خصم مبكّر على باقة عطلة ٥ ليالٍ',
                'title_en' => 'Early bird — 5-night beach bundle',
                'desc_ar' => 'لحجوزات مُسبقة — يشمل تنسيق الإقامة حسب البرنامج.',
                'desc_en' => 'Book ahead: hotel coordination included where listed.',
                'badge_ar' => 'لمدة محدودة',
                'badge_en' => 'Limited time',
                'valid_note_ar' => 'سارٍ حسب التوافر',
                'valid_note_en' => 'Subject to availability',
                'wa_text_ar' => 'أرغب بعرض: باقة ٥ ليالٍ',
                'wa_text_en' => 'I would like the 5-night offer',
                'image' => 'https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?auto=format&fit=crop&w=1000&q=80',
                'sort_order' => 1,
            ],
            [
                'title_ar' => 'طيران + فندق',
                'title_en' => 'Flight + hotel combo',
                'desc_ar' => 'لوجهات مختارة — نربط تذكرتك بإقامة مُلائمة.',
                'desc_en' => 'Selected routes: we pair your ticket with a matching hotel.',
                'badge_ar' => 'مُوصى',
                'badge_en' => 'Popular',
                'valid_note_ar' => 'سعرٌ فرديٌ لكل تاريخ',
                'valid_note_en' => 'Priced per date — ask for a quote',
                'wa_text_ar' => 'أرغب باستفسار: طيران + فندق',
                'wa_text_en' => 'Quote for flight + hotel',
                'image' => 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=1000&q=80',
                'sort_order' => 2,
            ],
            [
                'title_ar' => 'جولة مدينة + نقل مطار',
                'title_en' => 'City tour + airport transfer',
                'desc_ar' => 'للمسافرين بوقت مُحدود.',
                'desc_en' => 'Short on time: transfer plus a compact city loop.',
                'badge_ar' => '٤–٦ ساعات',
                'badge_en' => '4–6 hours',
                'valid_note_ar' => 'يخضع لمواعيد الرحلة',
                'valid_note_en' => 'Depends on your flight time',
                'wa_text_ar' => 'جولة + نقل مطار',
                'wa_text_en' => 'City tour and airport transfer',
                'image' => 'https://images.unsplash.com/photo-1512343879784-a960bf40e7f2?auto=format&fit=crop&w=1000&q=80',
                'sort_order' => 3,
            ],
            [
                'title_ar' => 'تأمين سفري + دعم وثائق',
                'title_en' => 'Travel insurance + documents',
                'desc_ar' => 'نُسهّل ربط وثائقك بخيارات مُلائمة.',
                'desc_en' => 'Document checklist and travel insurance options for your trip.',
                'badge_ar' => 'جديد',
                'badge_en' => 'New',
                'valid_note_ar' => 'لمعظم الوجهات',
                'valid_note_en' => 'Most international routes',
                'wa_text_ar' => 'تأمين ووثائق',
                'wa_text_en' => 'Insurance and documents',
                'image' => 'https://images.unsplash.com/photo-1526778548025-fa2f459cd0c0?auto=format&fit=crop&w=1000&q=80',
                'sort_order' => 4,
            ],
        ];
        foreach ($offers as $o) {
            Offer::query()->updateOrCreate(
                ['sort_order' => $o['sort_order']],
                array_merge($o, ['is_active' => true]),
            );
        }
    }
}
