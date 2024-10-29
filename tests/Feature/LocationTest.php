<?php

namespace Tests\Feature;

use App\Models\Location as Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Faker\Factory as Faker;

class LocationTest extends TestCase
{
    use RefreshDatabase;

    // Her test çalıştığında veritabanını sıfırla

    /**
     * Test: Location oluşturma.
     *
     * @return void
     */
    public function test_it_creates_a_location()
    {

        $faker = Faker::create();

        $response = $this->postJson('/api/locations', [
            'name' => $faker->city,
            'latitude' => $faker->latitude,
            'longitude' => $faker->longitude,
            'hex' => $faker->hexColor,
        ]);

        $response->assertStatus(201);

    }

    /**
     * Test: Location listeleme.
     *
     * @return void
     */
    public function test_it_lists_locations()
    {
        $response = $this->getJson('/api/locations');

        $response->assertStatus(200);
    }

    /**
     * Test: Location güncelleme.
     *
     * @return void
     */
    public function test_it_updates_a_location()
    {
        $location = Model::factory()->create();

        $faker = Faker::create();

        $response = $this->putJson('/api/locations/' . $location->id, [
            'name' => $faker->city,
            'latitude' => $faker->latitude,
            'longitude' => $faker->longitude,
            'hex' => $faker->hexColor,
        ]);

        $response->assertStatus(200);
    }

    /**
     * Test: Location silme.
     *
     * @return void
     */
    public function test_it_deletes_a_location()
    {
        $location = Model::factory()->create();

        $response = $this->deleteJson('/api/locations/' . $location->id);

        $response->assertStatus(204);
    }

    /**
     * Test: Location detay.
     *
     * @return void
     */
    public function test_it_shows_a_location()
    {
        $location = Model::factory()->create();

        $response = $this->getJson('/api/locations/' . $location->id);

        $response->assertStatus(200);
    }

    public function test_it_validates_location_with_trash()
    {
        $location = Model::factory()->create();
        $location->delete();

        $response = $this->getJson('/api/locations/with-destroy');

        $response->assertStatus(200)
            ->assertJsonStructure([['deleted_at']]);

        foreach ($response->json() as $item) {
            $this->assertNotNull($item['deleted_at']);
        }
    }


}
