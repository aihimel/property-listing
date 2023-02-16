<?php

namespace Tests\Feature\API;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Property;

class PropertiesTest extends TestCase
{

    use RefreshDatabase;

    private string $routePrefix = 'api.properties.';

    /** @test */
    public function can_get_all_properties()
    {
        $property = Property::factory()->create();
        $response = $this->getJson(
            route($this->routePrefix . 'index')
        );
        $response->assertOk();
        $response->assertJson([
            'data' => [[
                'id' => $property->id,
                'type' => $property->type,
                'price' => $property->price,
                'description' => $property->description,
            ]]
        ]);
    }

    /** @test */
    public function can_store_a_property()
    {
        $property = Property::factory()->make();

        $response = $this->postJson(
            route($this->routePrefix . 'store'),
            $property->toArray()
        );

        $response->assertCreated();

        $response->assertJson(['data' => ['type' => $property->type]]);
        $this->assertDatabaseHas(
            'properties',
            $property->toArray()
        );
    }

    /** @test */
    public function can_update_a_property()
    {
        $existingProperty = Property::factory()->create();
        $newProperty = Property::factory()->make();

        $response = $this->putJson(
            route($this->routePrefix . 'update', $existingProperty),
            $newProperty->toArray()
        );

        $response->assertJson([
            'data' => [
                'id' => $existingProperty->id,
                'type' => $newProperty->type
            ]
        ]);

        $this->assertDatabaseHas(
            'properties',
            $newProperty->toArray()
        );

    }

    /** @test */
    public function can_delete_a_property()
    {
        $newProperty = Property::factory()->create();
        $response = $this->deleteJson(
            route($this->routePrefix . 'delete'),
            $newProperty->toArray()
        );
        $response->assertNoContent();
        $this->assertDatabaseMissing(
            'properties',
            $newProperty->toArray()
        );
    }
}
