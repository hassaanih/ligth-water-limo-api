<?php

namespace Database\Seeders;

use App\Models\VehicleTypes;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class VehicleTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        VehicleTypes::truncate();

        $vehicleTypes = array(
            ['id' => 1, 'name' => 'Sedan' ],
            ['id' => 2, 'name' => 'SUV' ],
            ['id' => 3, 'name' => 'Custom' ]
        );

        foreach ($vehicleTypes as $type) {
            VehicleTypes::insert($type);
        }

        Model::reguard();
    }
}
