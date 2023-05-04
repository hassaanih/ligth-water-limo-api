<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\LookupVehicles;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            // UserTableSeeder::class,
            // LookupCountryTableSeeder::class,
            // LookupStateTableSeeder::class,
            // LookupCityTableSeeder::class,
            LookupVehiclesTableSeeder::class,
            VehicleTypesTableSeeder::class,
            LookupLocationTypesTableSeeder::class
            
        ]);
    }
}
