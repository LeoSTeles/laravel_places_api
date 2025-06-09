<?php

namespace Tests\Feature;

use App\Models\Place;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;


class PlaceApiTest extends TestCase
{
    use RefreshDatabase;

    protected array $headers = [
        'Accept' => 'application/json',
        'Content-Type' => 'application/json'
    ];

    #[Test]
    public function can_list_all_places()
    {
        Place::factory()->count(3)->create();

        $response = $this->getJson('/api/places', $this->headers);

        $response->assertStatus(200)
                 ->assertJsonCount(3);
    }

    #[Test]
    public function can_filter_places_by_name()
    {
        Place::factory()->create(['name' => 'Beach Park']);
        Place::factory()->create(['name' => 'Other Place']);

        $response = $this->getJson('/api/places?name=Beach', $this->headers);

        $response->assertStatus(200)
                 ->assertJsonFragment(['name' => 'Beach Park'])
                 ->assertJsonMissing(['name' => 'Other Place']);
    }

    #[Test]
    public function can_get_a_specific_place()
    {
        $place = Place::factory()->create();

        $response = $this->getJson("/api/places/{$place->id}", $this->headers);

        $response->assertStatus(200)
                 ->assertJsonFragment(['id' => $place->id]);
    }

    #[Test]
    public function can_create_a_new_place()
    {
        $data = [
            'name' => 'New Place',
            'slug' => 'new-place',
            'city' => 'CityX',
            'state' => 'XY'
        ];

        $response = $this->postJson('/api/places', $data, $this->headers);

        $response->assertStatus(201)
                 ->assertJsonFragment($data);

        $this->assertDatabaseHas('places', $data);
    }

    #[Test]
    public function cannot_create_place_without_required_fields()
    {
        $response = $this->postJson('/api/places', [], $this->headers);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name', 'slug', 'city', 'state']);
    }

    #[Test]
    public function can_update_a_place()
    {
        $place = Place::factory()->create();

        $updateData = [
            'name' => 'Updated Name',
            'slug' => 'updated-name',
            'city' => 'Updated City',
            'state' => 'UP'
        ];

        $response = $this->putJson("/api/places/{$place->id}", $updateData, $this->headers);

        $response->assertStatus(200)
                 ->assertJsonFragment($updateData);

        $this->assertDatabaseHas('places', $updateData);
    }

    #[Test]
    public function can_delete_a_place()
    {
        $place = Place::factory()->create();

        $response = $this->deleteJson("/api/places/{$place->id}", [], $this->headers);

        $response->assertStatus(204);

        $this->assertDatabaseMissing('places', ['id' => $place->id]);
    }
}
