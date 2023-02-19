<?php

namespace Tests\Feature\API;

use App\Models\StructureType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StructureTypeTest extends TestCase
{

    use RefreshDatabase;
    private $routePrefix = 'api.structure_types.';
    private $tableName = 'structure_types';

    /** @test */
    public function can_get_all_structure_type()
    {
        $structureType = StructureType::factory()->create();
        $this->getJson(
            route($this->routePrefix . 'index')
        )->assertOk()->assertJson([
            'data' => [$structureType->toArray()]
        ]);
    }

    /** @test */
    public function can_create_a_structure_type()
    {
        $structureType = StructureType::factory()->make();
        $this->postJson(
            route($this->routePrefix . 'store'),
            $structureType->toArray()
        )->assertCreated()->assertJson([
            'data' => $structureType->toArray()
        ]);
    }

    /** @test */
    public function can_update_a_structure_type()
    {
        $structureType = StructureType::factory()->create();
        $newStructureType = StructureType::factory()->make();
        $this->putJson(
            route($this->routePrefix . 'update', $structureType),
            $newStructureType->toArray()
        )->assertOk()->assertJson([
            'data' => $newStructureType->toArray()
        ]);
    }

    /** @test */
    public function can_delete_a_structure_type()
    {
        $structureType = StructureType::factory()->create();
        $this->deleteJson(
            route($this->routePrefix . 'delete', $structureType)
        )->assertNoContent();
        $this->assertDatabaseMissing($this->tableName, $structureType->toArray());
    }
}
