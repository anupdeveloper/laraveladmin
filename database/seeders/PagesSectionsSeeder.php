<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PagesSectionsSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	*/
	public function run() {
		\DB::table('pages_sections')->delete();
		\DB::table('pages_sections')->insert([
			[
				'title' => 'Privacy Policy',
				'slug' => 'privacy_policy',
				'device_type' => 'web'
			],
			[
				'title' => 'Terms & Conditions',
				'slug' => 'terms_and_conditions',
				'device_type' => 'web'
			],
		]);
	}
}
