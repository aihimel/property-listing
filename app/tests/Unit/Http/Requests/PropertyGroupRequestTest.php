<?php

namespace Tests\Unit\Http\Requests;

use App\Models\Property;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PropertyGroupRequestTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected string $routePrefix = 'api.property_groups.';

    /** @test */
    public function title_is_required()
    {
        $validationField = 'title';
        $brokenRule = null;
        $property = Property::factory()->make([
            $validationField => $brokenRule
        ]);

        $this->postJson(
            route($this->routePrefix . 'store'),
            $property->toArray()
        )->assertJsonValidationErrors($validationField);
        $this->withoutExceptionHandling();
    }

    /** @test */
    public function title_must_not_exceed_256_characters()
    {
        $validationField = 'title';
        $brokenRule = $this->faker->words(259);
        $property = Property::factory()->make([
            $validationField => $brokenRule
        ]);

        $this->postJson(
            route($this->routePrefix . 'store'),
            $property->toArray()
        )->assertJsonValidationErrors($validationField);
        $this->withoutExceptionHandling();

    }

    /** @test */
    public function description_is_required()
    {
        $validationField = 'description';
        $brokenRule = null;
        $property = Property::factory()->make([
            $validationField => $brokenRule
        ]);

        $this->postJson(
            route($this->routePrefix . 'store'),
            $property->toArray()
        )->assertJsonValidationErrors($validationField);
        $this->withoutExceptionHandling();
    }

}
