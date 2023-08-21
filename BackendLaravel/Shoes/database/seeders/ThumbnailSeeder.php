<?php

namespace Database\Seeders;

use App\Models\Color;
use App\Models\Product;
use App\Models\ProductColorSizePrice;
use App\Models\product_colors;
use App\Models\Thumbnail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ThumbnailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $faker = Faker::create();
        $products_id = product_colors::pluck('id');
        $color_id = Color::pluck('id');
        foreach ($products_id as $value) {
            # code...
            Thumbnail::create([
                "product_colors_id" => $value,
                "image" => $faker->imageUrl(),
            ]);
        }
    }
}