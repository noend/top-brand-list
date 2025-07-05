<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;
use App\Models\Brand;
use App\Models\TopList;

class TopListSeeder extends Seeder
{
    public function run(): void
    {
        $countries = Country::all();
        $brands = Brand::all();
        $now = now();

        foreach ($countries as $country) {
            $positions = range(0, $brands->count() - 1);
            shuffle($positions);
            $i = 0;
            foreach ($brands as $brand) {
                TopList::insert([
                    'brand_id' => $brand->brand_id,
                    'country_id' => $country->id,
                    'position' => $positions[$i],
                    'created_at' => $now,
                ]);
                $i++;
            }
        }
    }
}
