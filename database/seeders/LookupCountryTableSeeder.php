<?php

namespace Database\Seeders;

use App\Models\LookupCountry;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class LookupCountryTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();
		DB::table('lookup_countries')->truncate();
		DB::unprepared(file_get_contents(base_path('database/sql/lookup_countries.sql')));
		// DB::statement("UPDATE lookup_countries SET `status`='inactive' WHERE id!=233");
	}
}
