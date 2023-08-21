<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $faker = Faker::create();
        $brands = [
            'Nike',
            'Adidas',
            'Puma',
            'Reebok',
            'Vans',
            'Converse',
            'New Balance',
            'Under Armour',
            'Timberland',
            'Salomon',
            // Thêm các hãng giày khác tùy ý
        ];
        foreach ($brands as $value) {
            Category::create([
                "name"=>$value
            ]);
        }
        
    }
}
