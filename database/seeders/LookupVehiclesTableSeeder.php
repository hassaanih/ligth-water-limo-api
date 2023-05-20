<?php

namespace Database\Seeders;

use App\Models\LookupVehicles;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class LookupVehiclesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        LookupVehicles::truncate();

        $vehicles = array(
            ['company' => 'Audi', 'model' => 'A6', 'vehicle_type_id' => 1],
            ['company' => 'Audi', 'model' => 'A8', 'vehicle_type_id' => 1],
            ['company' => 'Audi', 'model' => 'A8 L', 'vehicle_type_id' => 1],
            ['company' => 'Audi', 'model' => 'e-tron', 'vehicle_type_id' => 2],
            ['company' => 'BMW', 'model' => '5-Series 530e', 'vehicle_type_id' => 1],
            ['company' => 'BMW', 'model' => '5-series', 'vehicle_type_id' => 1],
            ['company' => 'BMW', 'model' => '7-Series 745e', 'vehicle_type_id' => 1],
            ['company' => 'BMW', 'model' => '7-series', 'vehicle_type_id' => 1],
            ['company' => 'BMW', 'model' => '740i', 'vehicle_type_id' => 1],
            ['company' => 'BMW', 'model' => 'X7', 'vehicle_type_id' => 2],
            ['company' => 'Cadillac', 'model' => 'Escalade', 'vehicle_type_id' => 2],
            ['company' => 'Cadillac', 'model' => 'Escalade ESV', 'vehicle_type_id' => 2],
            ['company' => 'Cadillac', 'model' => 'CT6', 'vehicle_type_id' => 1],
            ['company' => 'Cadillac', 'model' => 'XT6', 'vehicle_type_id' => 2],
            ['company' => 'Cadillac', 'model' => 'XTS', 'vehicle_type_id' => 1],
            ['company' => 'Chevrolet', 'model' => 'Suburban', 'vehicle_type_id' => 2],
            ['company' => 'Chevrolet', 'model' => 'Tahoe', 'vehicle_type_id' => 2],
            ['company' => 'Ford', 'model' => 'Expedition', 'vehicle_type_id' => 2],
            ['company' => 'GMC', 'model' => 'Yukon XL Denali', 'vehicle_type_id' => 2],
            ['company' => 'GMC', 'model' => 'Yukon XL', 'vehicle_type_id' => 2],
            ['company' => 'GMC', 'model' => 'Yukon', 'vehicle_type_id' => 2],
            ['company' => 'GMC', 'model' => 'Suburban', 'vehicle_type_id' => 2],
            ['company' => 'Infiniti', 'model' => 'QX56', 'vehicle_type_id' => 2],
            ['company' => 'Infiniti', 'model' => 'QX80', 'vehicle_type_id' => 2],
            ['company' => 'Lexus', 'model' => 'LX', 'vehicle_type_id' => 2],
            ['company' => 'Lexus', 'model' => 'GS', 'vehicle_type_id' => 1],
            ['company' => 'Lexus', 'model' => 'LS', 'vehicle_type_id' => 1],
            ['company' => 'Lincoln', 'model' => 'Navigator', 'vehicle_type_id' => 2],
            ['company' => 'Lincoln', 'model' => 'Aviator', 'vehicle_type_id' => 2],
            ['company' => 'Lincoln', 'model' => 'Continental', 'vehicle_type_id' => 1],
            ['company' => 'Lincoln', 'model' => 'Corsair', 'vehicle_type_id' => 1],
            ['company' => 'Lincoln', 'model' => 'MKT', 'vehicle_type_id' => 1],
            ['company' => 'Lincoln', 'model' => 'Nautilus', 'vehicle_type_id' => 2],
            ['company' => 'Mercedes-Benz', 'model' => 'EQS', 'vehicle_type_id' => 1],
            ['company' => 'Mercedes-Benz', 'model' => 'E-Class', 'vehicle_type_id' => 1],
            ['company' => 'Mercedes-Benz', 'model' => 'E350e', 'vehicle_type_id' => 1],
            ['company' => 'Mercedes-Benz', 'model' => 'GL-Class', 'vehicle_type_id' => 2],
            ['company' => 'Mercedes-Benz', 'model' => 'GLE-Class', 'vehicle_type_id' => 2],
            ['company' => 'Mercedes-Benz', 'model' => 'GLS-Class', 'vehicle_type_id' => 2],
            ['company' => 'Mercedes-Benz', 'model' => 'S-Class', 'vehicle_type_id' => 1],
            ['company' => 'Tesla', 'model' => 'Model S', 'vehicle_type_id' => 1],
            ['company' => 'Tesla', 'model' => 'Model X', 'vehicle_type_id' => 2],
            ['company' => 'Tesla', 'model' => 'Model Y', 'vehicle_type_id' => 2],
            ['company' => 'Volvo', 'model' => 'S90', 'vehicle_type_id' => 1],
            ['company' => 'Volvo', 'model' => 'S90 Hybrid', 'vehicle_type_id' => 1],
            ['company' => 'Volvo', 'model' => 'XC90', 'vehicle_type_id' => 2],
            ['company' => 'Volvo', 'model' => 'XC90 Hybrid', 'vehicle_type_id' => 2],
        );
        

        // Loop through each user above and create the record for them in the database
        foreach ($vehicles as $vehicle) {
            LookupVehicles::insert($vehicle);
        }

        Model::reguard();
    }
}
