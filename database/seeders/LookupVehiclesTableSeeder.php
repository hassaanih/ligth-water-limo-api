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
            ['company' => 'Audi', 'model' => 'A6'],
            ['company' => 'Audi', 'model' => 'A8'],
            ['company' => 'Audi', 'model' => 'A8 L'],
            ['company' => 'Audi', 'model' => 'e-tron'],
            ['company' => 'BMW', 'model' => '5-Series 530e'],
            ['company' => 'BMW', 'model' => '5-series'],
            ['company' => 'BMW', 'model' => '7-Series 745e '],
            ['company' => 'BMW', 'model' => '7-series'],
            ['company' => 'BMW', 'model' => '740i'],
            ['company' => 'BMW', 'model' => 'X7'],
            ['company' => 'Cadillac', 'model' => 'Escalade'],
            ['company' => 'Cadillac', 'model' => 'Escalade ESV'],
            ['company' => 'Cadillac', 'model' => 'CT6 '],
            ['company' => 'Cadillac', 'model' => 'XT6'],
            ['company' => 'Cadillac', 'model' => 'XTS'],
            ['company' => 'Chevrolet', 'model' => 'Suburban'],
            ['company' => 'Chevrolet', 'model' => 'Tahoe'],
            ['company' => 'Fo', 'model' => 'Expedition'],
            ['company' => 'GMC', 'model' => 'Yukon XL Denali '],
            ['company' => 'GMC', 'model' => 'Yukon XL'],
            ['company' => 'GMC', 'model' => 'Yukon'],
            ['company' => 'GMC', 'model' => 'Suburban '],
            ['company' => 'Infiniti', 'model' => 'QX56'],
            ['company' => 'Infiniti', 'model' => 'QX80'],
            ['company' => 'Lexus', 'model' => 'LX'],
            ['company' => 'Lexus', 'model' => 'GS'],
            ['company' => 'Lexus', 'model' => 'LS'],
            ['company' => 'Lincoln', 'model' => 'Navigator'],
            ['company' => 'Lincoln', 'model' => 'Aviator'],
            ['company' => 'Lincoln', 'model' => 'Continental'],
            ['company' => 'Lincoln', 'model' => 'Corsair'],
            ['company' => 'Lincoln', 'model' => 'MKT'],
            ['company' => 'Lincoln', 'model' => 'Nautilus'],
            ['company' => 'Mercedes-Benz', 'model' => 'EQS'],
            ['company' => 'Mercedes-Benz', 'model' => 'E-Class'],
            ['company' => 'Mercedes-Benz', 'model' => 'E350e'],
            ['company' => 'Mercedes-Benz', 'model' => 'GL-Class'],
            ['company' => 'Mercedes-Benz', 'model' => 'GLE-Class'],
            ['company' => 'Mercedes-Benz', 'model' => 'GLS-Class'],
            ['company' => 'Mercedes-Benz', 'model' => 'S-Class'],
            ['company' => 'Tesla', 'model' => 'Model S'],
            ['company' => 'Tesla', 'model' => 'Model X'],
            ['company' => 'Tesla', 'model' => 'Model Y'],
            ['company' => 'Volvo', 'model' => 'S90'],
            ['company' => 'Volvo', 'model' => 'S90 Hybrid'],
            ['company' => 'Volvo', 'model' => 'XC90'],
            ['company' => 'Volvo', 'model' => 'XC90 Hybrid'],


        );

        // Loop through each user above and create the record for them in the database
        foreach ($vehicles as $vehicle) {
            LookupVehicles::insert($vehicle);
        }

        Model::reguard();
    }
}
