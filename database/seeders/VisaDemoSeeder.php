<?php

namespace Database\Seeders;

use App\Models\Visa;
use App\Models\VisaCategory;
use Illuminate\Database\Seeder;

class VisaDemoSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'slug' => 'tourist',
                'name_ar' => 'سياحية',
                'name_en' => 'Tourist',
                'sort_order' => 1,
            ],
            [
                'slug' => 'business',
                'name_ar' => 'أعمال',
                'name_en' => 'Business',
                'sort_order' => 2,
            ],
            [
                'slug' => 'family-visit',
                'name_ar' => 'زيارة عائلية',
                'name_en' => 'Family Visit',
                'sort_order' => 3,
            ],
        ];

        $categoryIds = [];

        foreach ($categories as $category) {
            $record = VisaCategory::query()->updateOrCreate(
                ['slug' => $category['slug']],
                [
                    'name_ar' => $category['name_ar'],
                    'name_en' => $category['name_en'],
                    'sort_order' => $category['sort_order'],
                    'is_active' => true,
                ],
            );

            $categoryIds[$category['slug']] = $record->id;
        }

        $visas = [
            [
                'slug' => 'tourist',
                'country_ar' => 'السعودية',
                'country_en' => 'Saudi Arabia',
                'code_ar' => 'KSA VISA',
                'code_en' => 'KSA VISA',
                'processing_time_ar' => '96 ساعة',
                'processing_time_en' => '96 Hours',
                'validity_ar' => '1 يوم',
                'validity_en' => '1 day(s)',
                'price_old' => 1500,
                'price_from' => 800,
                'currency' => 'USD',
                'discount_percent' => 47,
                'sort_order' => 1,
                'image' => 'https://images.unsplash.com/photo-1569748130764-3fed0c102c59?auto=format&fit=crop&w=1200&q=80',
            ],
            [
                'slug' => 'tourist',
                'country_ar' => 'أستراليا',
                'country_en' => 'Australia',
                'code_ar' => 'AU-STU500',
                'code_en' => 'AU-STU500',
                'processing_time_ar' => '4 أيام',
                'processing_time_en' => '4 day(s)',
                'validity_ar' => 'سياحية قصيرة',
                'validity_en' => 'Short stay',
                'price_old' => 351,
                'price_from' => 300,
                'currency' => 'USD',
                'discount_percent' => 15,
                'sort_order' => 2,
                'image' => 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?auto=format&fit=crop&w=1200&q=80',
            ],
            [
                'slug' => 'business',
                'country_ar' => 'الإمارات',
                'country_en' => 'United Arab Emirates',
                'code_ar' => 'UAE-BIZ30',
                'code_en' => 'UAE-BIZ30',
                'processing_time_ar' => '48 ساعة',
                'processing_time_en' => '48 hours',
                'validity_ar' => '30 يوم',
                'validity_en' => '30 days',
                'price_old' => 420,
                'price_from' => 340,
                'currency' => 'USD',
                'discount_percent' => 19,
                'sort_order' => 3,
                'image' => 'https://images.unsplash.com/photo-1512453979798-5ea266f8880c?auto=format&fit=crop&w=1200&q=80',
            ],
            [
                'slug' => 'business',
                'country_ar' => 'المملكة المتحدة',
                'country_en' => 'United Kingdom',
                'code_ar' => 'UK-BIZ180',
                'code_en' => 'UK-BIZ180',
                'processing_time_ar' => '7 أيام',
                'processing_time_en' => '7 days',
                'validity_ar' => '6 أشهر',
                'validity_en' => '6 months',
                'price_old' => 780,
                'price_from' => 690,
                'currency' => 'USD',
                'discount_percent' => 12,
                'sort_order' => 4,
                'image' => 'https://images.unsplash.com/photo-1472396961693-142e6e269027?auto=format&fit=crop&w=1200&q=80',
            ],
            [
                'slug' => 'family-visit',
                'country_ar' => 'الولايات المتحدة',
                'country_en' => 'United States',
                'code_ar' => 'US-FAM90',
                'code_en' => 'US-FAM90',
                'processing_time_ar' => '10 أيام',
                'processing_time_en' => '10 days',
                'validity_ar' => '90 يوم',
                'validity_en' => '90 days',
                'price_old' => 620,
                'price_from' => 540,
                'currency' => 'USD',
                'discount_percent' => 13,
                'sort_order' => 5,
                'image' => 'https://images.unsplash.com/photo-1483683804023-6ccdb62f86ef?auto=format&fit=crop&w=1200&q=80',
            ],
            [
                'slug' => 'family-visit',
                'country_ar' => 'كندا',
                'country_en' => 'Canada',
                'code_ar' => 'CA-VIS600',
                'code_en' => 'CA-VIS600',
                'processing_time_ar' => '6 أيام',
                'processing_time_en' => '6 days',
                'validity_ar' => '60 يوم',
                'validity_en' => '60 days',
                'price_old' => 388,
                'price_from' => 300,
                'currency' => 'USD',
                'discount_percent' => 23,
                'sort_order' => 6,
                'image' => 'https://images.unsplash.com/photo-1450101499163-c8848c66ca85?auto=format&fit=crop&w=1200&q=80',
            ],
        ];

        foreach ($visas as $visa) {
            Visa::query()->updateOrCreate(
                [
                    'country_en' => $visa['country_en'],
                    'code_en' => $visa['code_en'],
                ],
                [
                    'visa_category_id' => $categoryIds[$visa['slug']] ?? null,
                    'country_ar' => $visa['country_ar'],
                    'code_ar' => $visa['code_ar'],
                    'processing_time_ar' => $visa['processing_time_ar'],
                    'processing_time_en' => $visa['processing_time_en'],
                    'validity_ar' => $visa['validity_ar'],
                    'validity_en' => $visa['validity_en'],
                    'price_old' => $visa['price_old'],
                    'price_from' => $visa['price_from'],
                    'currency' => $visa['currency'],
                    'discount_percent' => $visa['discount_percent'],
                    'sort_order' => $visa['sort_order'],
                    'image' => $visa['image'],
                    'is_active' => true,
                    'wa_text_ar' => 'أرغب في الاستفسار عن تأشيرة '.$visa['country_ar'].' ('.$visa['code_ar'].')',
                    'wa_text_en' => 'I would like to ask about '.$visa['country_en'].' visa ('.$visa['code_en'].')',
                ],
            );
        }
    }
}
