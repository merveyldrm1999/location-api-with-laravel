<?php

namespace Database\Seeders;

use App\Models\Location as Model;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        Model::create([
            'name' => $faker->city,
            'latitude' => $faker->latitude(-90, 90),
            'longitude' => $faker->longitude(-180, 180),
            'hex' => $faker->hexColor,
        ]);

    }
}
