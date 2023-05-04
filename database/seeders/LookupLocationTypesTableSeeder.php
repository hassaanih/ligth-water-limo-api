<?php

namespace Database\Seeders;

use App\Models\LookupLocationTypes;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class LookupLocationTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        LookupLocationTypes::truncate();

        $locationTypes = array(
            ['id' => 1, 'name' => 'Sedan' ],
            ['id' => 2, 'name' => 'SUV' ],
            ['id' => 3, 'name' => 'Custom' ]
        );

        foreach ($locationTypes as $type) {
            LookupLocationTypes::insert($type);
        }

        Model::reguard();
    }
}
