<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\LookupCity;

class LookupCityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        DB::table('lookup_cities')->truncate();
        ini_set('memory_limit', '512M');
        DB::unprepared(file_get_contents(base_path('database/sql/lookup_cities_1.sql')));
        DB::unprepared(file_get_contents(base_path('database/sql/lookup_cities_2.sql')));
        DB::unprepared(file_get_contents(base_path('database/sql/lookup_cities_3.sql')));
        DB::unprepared(file_get_contents(base_path('database/sql/lookup_cities_4.sql')));
        DB::unprepared(file_get_contents(base_path('database/sql/lookup_cities_5.sql')));
        DB::unprepared(file_get_contents(base_path('database/sql/lookup_cities_6.sql')));
        DB::unprepared(file_get_contents(base_path('database/sql/lookup_cities_7.sql')));
        DB::unprepared(file_get_contents(base_path('database/sql/lookup_cities_8.sql')));
        DB::unprepared(file_get_contents(base_path('database/sql/lookup_cities_9.sql')));
        // DB::statement("UPDATE lookup_cities SET `status`='inactive' WHERE blueex_code IS NULL");
    }
}
