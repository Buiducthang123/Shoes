<?php

namespace Database\Seeders;

use App\Models\Color;
use App\Models\Product;
use App\Models\ProductColorSizePrice;
use App\Models\product_colors;
use App\Models\Size;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class ProductColorSizePriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $faker = Faker::create();
        $products_id = product_colors::pluck('id');
     
        $sizes_id = Size::pluck('id');
        foreach ($products_id as $value) {
            ProductColorSizePrice::create([
                'product_colors_id'=>$value,
                'size_id'=>$faker->randomElement($sizes_id),
                'cost' => $faker->randomFloat(2, 10, 100),
            ]);
        }
        

    }
}
