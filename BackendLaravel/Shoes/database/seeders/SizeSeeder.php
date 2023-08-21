<?php

namespace Database\Seeders;

use App\Models\Size;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Facker;
class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        //
        $n = 29;
        $faker = Facker::create();
        for ($i=0; $i<11 ; $i++) { 
            Size::create([
                'name'=> $n
            ]);
            $n++;
        }
    }
}
