<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class JobIndustriesSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	*/
	public function run() {

		\DB::table('job_industries')->delete();
		\DB::table('job_industries')->insert([
			[
				'name' => 'Accountancy',
				'slug' => 'accountancy',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'Administration',
				'slug' => 'administration',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'Advertising',
				'slug' => 'advertising',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'Aerospace',
				'slug' => 'aerospace',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'Apprenticeships',
				'slug' => 'apprenticeships',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'Automotive',
				'slug' => 'automotive',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'Banking',
				'slug' => 'banking',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'Call Centre',
				'slug' => 'call_centre',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'Catering',
				'slug' => 'catering',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'Charity',
				'slug' => 'charity',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'Construction',
				'slug' => 'construction',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'Customer Service',
				'slug' => 'customer_service',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'Education',
				'slug' => 'education',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'Energy Renewable',
				'slug' => 'energy_renewable',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'Engineering',
				'slug' => 'engineering',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'Finance',
				'slug' => 'finance',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'Graduate',
				'slug' => 'graduate',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'Healthcare',
				'slug' => 'healthcare',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'Hospitality',
				'slug' => 'hospitality',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'Human Resources',
				'slug' => 'human_resources',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'Insurance',
				'slug' => 'insurance',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'IT and Telecoms',
				'slug' => 'it_and_telecoms',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'Legal',
				'slug' => 'legal',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'Leisure and Tourism',
				'slug' => 'leisure_and_tourism',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'Logistics',
				'slug' => 'logistics',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'Management',
				'slug' => 'management',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'Manufacturing',
				'slug' => 'manufacturing',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'Marketing',
				'slug' => 'marketing',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'Media',
				'slug' => 'media',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'Nursing',
				'slug' => 'nursing',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'Oil and Gas',
				'slug' => 'oil_and_gas',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'Personal Assistant',
				'slug' => 'personal_assistant',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'Part Time',
				'slug' => 'part_time',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'Pharmaceutical',
				'slug' => 'pharmaceutical',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'PR',
				'slug' => 'pr',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'Public Sector',
				'slug' => 'public_sector',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'Recruitment',
				'slug' => 'recruitment',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'Retail',
				'slug' => 'retail',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'Sales',
				'slug' => 'sales',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'Science',
				'slug' => 'science',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'Social Work',
				'slug' => 'social_work',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'Teaching',
				'slug' => 'teaching',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'Temporary',
				'slug' => 'temporary',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'Transport',
				'slug' => 'transport',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'Utilities',
				'slug' => 'utilities',
				'description' => 'desc',
				'status' => 1
			],
		]);
	}
}
