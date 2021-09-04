<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('countries')->delete();

		$countries = array(
			array('code' => 'US', 'name' => 'United States'),
			array('code' => 'GB', 'name' => 'United Kingdom')
		);

		\DB::table('countries')->insert($countries);
    }
}
