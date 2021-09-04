<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class JobLocationsSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	*/
	public function run() {

		\DB::table('job_locations')->delete();
		\DB::table('job_locations')->insert([
			[
				'name' => 'Cymru Wales',
				'slug' => 'cymru_wales',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'East Midlands',
				'slug' => 'east_midlands',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'East of England',
				'slug' => 'east_of_england',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'London',
				'slug' => 'london',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'North East and Cumbria',
				'slug' => 'north_east_and_cumbria',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'North West',
				'slug' => 'north_west',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'Northern Ireland',
				'slug' => 'northern_ireland',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'Scotland Centre',
				'slug' => 'scotland_centre',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'South East',
				'slug' => 'south_east',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'South West',
				'slug' => 'south_west',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'West Midlands',
				'slug' => 'west_midlands',
				'description' => 'desc',
				'status' => 1
			],
		]);
	}
}
