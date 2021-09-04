<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class JobFunctionsSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	*/
	public function run() {

		\DB::table('job_functions')->delete();
		\DB::table('job_functions')->insert([
			'name' => 'Designer',
			'slug' => 'designer',
			'description' => 'desc',
			'status' => 1
		]);
	}
}
