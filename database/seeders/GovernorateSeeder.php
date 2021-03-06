<?php

namespace Database\Seeders;

use App\Models\Governorate;
use Illuminate\Database\Seeder;

class GovernorateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $governorates = [
            [
                'governorate_name_en' => 'Cairo',
                'governorate_name_ar' => 'القاهرة'
            ],
            [
                'governorate_name_en' => 'Giza',
                'governorate_name_ar' => 'الجيزة'
            ],
            /* [
                'governorate_name_en' => 'Alexandria',
                'governorate_name_ar' => 'الأسكندرية'
            ],
            [
                'governorate_name_en' => 'Dakahlia',
                'governorate_name_ar' => 'الدقهلية'
            ],
            [
                'governorate_name_en' => 'Red Sea',
                'governorate_name_ar' => 'البحر الأحمر'
            ],
            [
                'governorate_name_en' => 'Beheira',
                'governorate_name_ar' => 'البحيرة'
            ],
            [
                'governorate_name_en' => 'Fayoum',
                'governorate_name_ar' => 'الفيوم'
            ],
            [
                'governorate_name_en' => 'Gharbiya',
                'governorate_name_ar' => 'الغربية'
            ],
            [
                'governorate_name_en' => 'Ismailia',
                'governorate_name_ar' => 'الإسماعلية'
            ],
            [
                'governorate_name_en' => 'Menofia',
                'governorate_name_ar' => 'المنوفية'
            ],
            [
                'governorate_name_en' => 'Minya',
                'governorate_name_ar' => 'المنيا'
            ],
            [
                'governorate_name_en' => 'Qaliubiya',
                'governorate_name_ar' => 'القليوبية'
            ],
            [
                'governorate_name_en' => 'New Valley',
                'governorate_name_ar' => 'الوادي الجديد'
            ],
            [
                'governorate_name_en' => 'Suez',
                'governorate_name_ar' => 'السويس'
            ],
            [
                'governorate_name_en' => 'Aswan',
                'governorate_name_ar' => 'اسوان'
            ],
            [
                'governorate_name_en' => 'Assiut',
                'governorate_name_ar' => 'اسيوط'
            ],
            [
                'governorate_name_en' => 'Beni Suef',
                'governorate_name_ar' => 'بني سويف'
            ],
            [
                'governorate_name_en' => 'Port Said',
                'governorate_name_ar' => 'بورسعيد'
            ],
            [
                'governorate_name_en' => 'Damietta',
                'governorate_name_ar' => 'دمياط'
            ],
            [
                'governorate_name_en' => 'Sharkia',
                'governorate_name_ar' => 'الشرقية'
            ],
            [
                'governorate_name_en' => 'South Sinai',
                'governorate_name_ar' => 'جنوب سيناء'
            ],
            [
                'governorate_name_en' => 'Kafr Al sheikh',
                'governorate_name_ar' => 'كفر الشيخ'
            ],
            [
                'governorate_name_en' => 'Matrouh',
                'governorate_name_ar' => 'مطروح'
            ],
            [
                'governorate_name_en' => 'Luxor',
                'governorate_name_ar' => 'الأقصر'
            ],
            [
                'governorate_name_en' => 'Qena',
                'governorate_name_ar' => 'قنا'
            ],
            [
                'governorate_name_en' => 'North Sinai',
                'governorate_name_ar' => 'شمال سيناء'
            ],
            [
                'governorate_name_en' => 'Sohag',
                'governorate_name_ar' => 'سوهاج'
            ], */
        ];

        foreach($governorates as $governorate){
            Governorate::create($governorate);
        }

    }
}

