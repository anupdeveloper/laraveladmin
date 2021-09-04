<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	*/
	public function run() {
		\DB::table('roles')->delete();
		\DB::table('roles')->insert([
			[
				'name' => 'Super Admin',
				'tag' => 'super_admin'
			],
			[
				'name' => 'Admin',
				'tag' => 'admin'
			],
			[
				'name' => 'Viewer',
				'tag' => 'viewer'
			],
		]);
	}
}
