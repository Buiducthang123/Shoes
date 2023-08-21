<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $faker = Faker::create();
        $categories_id = Category::pluck('id');// lấy ra id bảng categories =>mảng
        for ($i = 0; $i < 20; $i++) {
            Product::create([
                'category_id' => $faker->randomElement($categories_id),
                'name' => $faker->word(),
                'quantity' => $faker->numberBetween(1, 100),
                'base_price'=>$faker->numberBetween(1,200),
                'description' => $faker->text(200),
                'image' => $faker->imageUrl(),
                'disabled' => $faker->boolean,
                'sales_quantity'=>$faker->numberBetween()
            ]);
        }
    }
}
