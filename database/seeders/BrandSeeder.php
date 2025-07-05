<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();
        DB::table('brands')->insert([
            [
                'brand_id' => 1,
                'brand_name' => 'Unibet',
                'brand_image' => 'https://www.opnminded.com/content/cms-images/824859960f5b676d684cfad1cbec3ccd565e3012-600x240.png',
                'rating' => 5,
                'created_at' => $now,
            ],
            [
                'brand_id' => 2,
                'brand_name' => 'Betclic',
                'brand_image' => 'https://www.opnminded.com/content/cms-images/5fdf5e6d52a9f8338914beebdd23b30c76b0a692-600x240.webp',
                'rating' => 5,
                'created_at' => $now,
            ],
            [
                'brand_id' => 3,
                'brand_name' => 'PokerStars',
                'brand_image' => 'https://www.opnminded.com/content/cms-images/a3a8ec693aabd806ab79c9022661b104b3a821cb-600x240.png',
                'rating' => 5,
                'created_at' => $now,
            ],
            [
                'brand_id' => 4,
                'brand_name' => 'NetBet',
                'brand_image' => 'https://www.opnminded.com/content/cms-images/1b57a90ea413e3d76964c2a487d65c305770e5df-600x240.png',
                'rating' => 5,
                'created_at' => $now,
            ],
            [
                'brand_id' => 5,
                'brand_name' => 'bwin',
                'brand_image' => 'https://www.opnminded.com/content/cms-images/96091301397c3ef00a90096bcfad30bf3afe1448-600x240.png',
                'rating' => 5,
                'created_at' => $now,
            ],
        ]);
    }
}
