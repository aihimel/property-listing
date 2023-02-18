<?php

namespace Tests\Feature\API;

use App\Models\Property;
use App\Models\PropertyGroup;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PropertyGroupsTest extends TestCase
{

    use RefreshDatabase;

    private string $routePrefix = 'api.property_groups.';
    private string $tableName = 'property_groups';

    /** @test  */
    public function can_get_all_property_groups()
    {
        $propertyGroup = PropertyGroup::factory()->create();

        $this->getJson(
            route($this->routePrefix . 'index')
        )->assertOk()->assertJson([
            'data' => [
                [
                    'id' => $propertyGroup->id,
                    'title' => $propertyGroup->title,
                    'description' => $propertyGroup->description
                ]
            ]
        ]);
    }

    /** @test */
    public function can_store_a_property_group()
    {
        $propertyGroup = PropertyGroup::factory()->make();

        $this->postJson(
            route($this->routePrefix . 'store'),
            $propertyGroup->toArray()
        )->assertCreated()->assertJson([
            'data' => $propertyGroup->toArray()
        ]);
    }

    /** @test  */
    public function can_update_a_property_group()
    {
        $propertyGroup = PropertyGroup::factory()->create();
        $newPropertyGroup = PropertyGroup::factory()->make();

        $this->putJson(
            route($this->routePrefix . 'update', $propertyGroup),
            $newPropertyGroup->toArray()
        )->assertJson([
            'data' => [
                'title' => $newPropertyGroup->title,
                'description' => $newPropertyGroup->description
            ]
        ]);

        $this->assertDatabaseHas(
            $this->tableName,
            $newPropertyGroup->toArray()
        );
    }

    /** @test */
    public function can_delete_a_property_group()
    {
        $propertyGroup = PropertyGroup::factory()->create();
        $this->deleteJson(
            route($this->routePrefix . 'delete', $propertyGroup)
        )->assertNoContent();
        $this->assertDatabaseMissing(
            $this->tableName,
            $propertyGroup->toArray()
        );
    }

}
