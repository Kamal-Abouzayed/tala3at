<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cities = [
            [
                'governorate_id' => 1,
                'city_name_ar'   => '15 مايو',
                'city_name_en'   => '15 May',
            ],
            [
                'governorate_id' => 1,
                'city_name_ar'   => 'الازبكية',
                'city_name_en'   => 'Al Azbakeyah'
            ],
            [
                'governorate_id' => 1,
                'city_name_ar'   => 'البساتين',
                'city_name_en'   => 'Al Basatin'
            ],
            [
                'governorate_id' => 1,
                'city_name_ar'   => 'التبين',
                'city_name_en'   => 'Tebin'
            ],
            [
                'governorate_id' => 1,
                'city_name_ar'   => 'الخليفة',
                'city_name_en'   => 'El-Khalifa'
            ],
            [
                'governorate_id' => 2,
                'city_name_ar'   => 'الجيزة',
                'city_name_en'   => 'Giza',
            ],
            [
                'governorate_id' => 2,
                'city_name_ar'   => 'السادس من أكتوبر',
                'city_name_en'   => 'Sixth of October',
            ],
            [
                'governorate_id' => 2,
                'city_name_ar'   => 'الشيخ زايد',
                'city_name_en'   => 'Cheikh Zayed',
            ],
            [
                'governorate_id' => 2,
                'city_name_ar'   => 'الحوامدية',
                'city_name_en'   => 'Hawamdiyah',
            ],
            [
                'governorate_id' => 2,
                'city_name_ar'   => 'البدرشين',
                'city_name_en'   => 'Al Badrashear',
            ],
        ];

        foreach($cities as $city){
            City::create($city);
        }
    }
}
