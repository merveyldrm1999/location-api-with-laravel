<?php

namespace Tests\Feature;

use App\Models\Location as Model;
use Tests\TestCase;
use Faker\Factory as Faker;

class DistanceTest extends TestCase
{


    public function test_it_calculates_distance_between_two_locations()
    {
        $faker = Faker::create();

        Model::factory()->create([
            'name' => $faker->name,
            'latitude' => $faker->latitude,
            'longitude' => $faker->longitude,
            'hex' => '#000000',
        ]);

        Model::factory()->create([
            'name' => $faker->name,
            'latitude' => $faker->latitude,
            'longitude' => $faker->longitude,
            'hex' => '#000000',
        ]);


        $response = $this->postJson('/api/locations/distance', [
            'latitude' => $faker->latitude,
            'longitude' => $faker->longitude,
        ]);

        $responseData = $response->json();

        $distances = array_column($responseData, 'distance');

        $sortedDistances = $distances;
        sort($sortedDistances);

        $this->assertEquals($sortedDistances, $distances, 'Mesafeler küçükten büyüğe sıralı olmalı');

        $response->assertStatus(200);

    }
}
