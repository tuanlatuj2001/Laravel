<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Countrie;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Deparment>
 */
class DeparmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            
            'deparment_name'=>fake()->text(10),
            'floor' =>rand(1,10),
            'until' =>rand(1,10),
            'building' => fake()->text(10),
            'street' => fake()->text(10),
            'city' => fake()->text(10),
            'state' => fake()->text(10),
            'countrie_id' => Countrie::factory(),
            'zipcode' => Str::random(10),
            
        ];
    }
}
