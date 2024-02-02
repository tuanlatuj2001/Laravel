<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Location;
use App\Models\Deparment;
use App\Models\Countrie;
use App\Models\Categorie;
use App\Models\Manufacturer;
use App\Models\Supplier;
use App\Models\Modele;
use App\Models\Asset;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Countrie::factory(10)->create(); 
        Deparment::factory(10)->create(); 
        Location::factory(10)->create(); 
        User::factory(20)->create(); 
        Categorie::factory(10)->create(); 
        Manufacturer::factory(10)->create(); 
        Supplier::factory(10)->create(); 
        Modele::factory(10)->create(); 
        Asset::factory(20)->create(); 

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
