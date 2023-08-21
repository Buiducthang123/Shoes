<?php

namespace Database\Seeders;

use App\Models\BestSellingProducts;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class BestSellingProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $faker= Faker::create();
        $products_id = Product::pluck('id');

        foreach ($products_id as $product_id) {
            BestSellingProducts::create([
                'product_id' => $product_id,
                'sales_quantity' => $faker->numberBetween(50, 2000),
                
            ]);
        }
    }
}
