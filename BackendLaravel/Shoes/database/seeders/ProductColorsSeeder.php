<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Color;
use App\Models\product_colors;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class ProductColorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $faker = Faker::create();
        $products_id = Product::pluck('id');
        $color_id = Color::pluck('id');

        foreach ($products_id as $value) {
            # code...
            product_colors::create([
                'product_id'=>$value,
                'color_id'=>$faker->randomElement($color_id)
            ]);
        }
    }
}
