<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Faker\Factory as Faker;
class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        for ($i=0; $i < 11 ; $i++) { 
            Color::create([
                'name'=>$faker->colorName(),
                'hex'=>$faker->hexColor(),
            ]);
        }
       
    }
}
