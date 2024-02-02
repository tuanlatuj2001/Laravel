<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Location;
use App\Models\Modele;
use App\Models\Supplier;
use App\Models\Manufacturer;
use App\Models\Categorie;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Asset>
 */
class AssetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            
            'asset_name' => fake()->text(10),
            'code' => Str::random(10),
            'location_id' => Location::factory(),
            'condition' => random_int(0, 5),
            'modele_id' => Modele::factory(),
            'serial' => Str::random(10),
            'supplier_id' => Supplier::factory(),
            'manufacturer_id' => Manufacturer::factory(),
            'categorie_id' => Categorie::factory(),
            'price' =>random_int(10000000, 50000000),
            'warranty' =>random_int(12, 24),
            'asset_code' =>random_int(10000000000, 99999999999),
            
        ];
    }
}
