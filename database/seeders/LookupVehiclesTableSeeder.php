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
            ['Audi' => 'A6'],
            ['Audi' => 'A8'],
            ['Audi' => 'A8 L'],
            ['Audi' => 'e-tron'],
            ['BMW' => '5-Series 530e'],
            ['BMW' => '5-series'],
            ['BMW' => '7-Series 745e '],
            ['BMW' => '7-series'],
            ['BMW' => '740i'],
            ['BMW' => 'X7'],
            ['Cadillac' => 'Escalade'],
            ['Cadillac' => 'Escalade ESV'],
            ['Cadillac' => 'CT6 '],
            ['Cadillac' => 'XT6'],
            ['Cadillac' => 'XTS'],
            ['Chevrolet' => 'Suburban'],
            ['Chevrolet' => 'Tahoe'],
            ['Fo' => 'Expedition'],
            ['GMC' => 'Yukon XL Denali '],
            ['GMC' => 'Yukon XL'],
            ['GMC' => 'Yukon'],
            ['GMC' => 'Suburban '],
            ['Infiniti' => 'QX56'],
            ['Infiniti' => 'QX80'],
            ['Lexus' => 'LX'],
            ['Lexus' => 'GS'],
            ['Lexus' => 'LS'],
            ['Lincoln' => 'Navigator'],
            ['Lincoln' => 'Aviator'],
            ['Lincoln' => 'Continental'],
            ['Lincoln' => 'Corsair'],
            ['Lincoln' => 'MKT'],
            ['Lincoln' => 'Nautilus'],
            ['Mercedes-Benz' => 'EQS'],
            ['Mercedes-Benz' => 'E-Class'],
            ['Mercedes-Benz' => 'E350e'],
            ['Mercedes-Benz' => 'GL-Class'],
            ['Mercedes-Benz' => 'GLE-Class'],
            ['Mercedes-Benz' => 'GLS-Class'],
            ['Mercedes-Benz' => 'S-Class'],
            ['Tesla' => 'Model S'],
            ['Tesla' => 'Model X'],
            ['Tesla' => 'Model Y'],
            ['Volvo' => 'S90'],
            ['Volvo' => 'S90 Hybrid'],
            ['Volvo' => 'XC90'],
            ['Volvo' => 'XC90 Hybrid'],


        );

        // Loop through each user above and create the record for them in the database
        foreach ($vehicles as $vehicle) {
            LookupVehicles::insert($vehicle);
        }

        Model::reguard();
    }
}
