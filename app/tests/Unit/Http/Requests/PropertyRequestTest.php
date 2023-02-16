<?php

namespace Tests\Unit\Http\Requests;

use App\Models\Property;
use Illuminate\Foundation\Testing\RefreshDatabase;
//use PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PropertyRequestTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    private string $routePrefix = 'api.properties.';

    /** @test */
    public function type_is_required()
    {

        $validateFiled = 'type';
        $brokenRule = null;

        $property = Property::factory()->make([
            $validateFiled => $brokenRule
        ]);

        $this->postJson(
            route($this->routePrefix . 'store'),
            $property->toArray(),
        )->assertJsonValidationErrors($validateFiled);

        $this->withoutExceptionHandling();
    }

    /** @test */
    public function type_must_not_exceed_20_characters()
    {
        $validateField = 'type';
        $brokenRule = $this->faker->paragraph();

        $property = Property::factory()->make([
            $validateField => $brokenRule
        ]);

        $this->postJson(
            route($this->routePrefix . 'store'),
            $property->toArray()
        )->assertJsonValidationErrors($validateField);

        $this->withoutExceptionHandling();
    }

    /** @test */
    public function price_is_required()
    {
        $validationField = 'price';
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
    public function price_is_integer()
    {
        $validationField = 'price';
        $brokenRule = 'not-a-integer';

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
