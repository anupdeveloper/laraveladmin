<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DropdownsSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	*/
	public function run() {

		\DB::table('dropdowns')->delete();
		$dropdowns = [
			['name'=>'employment_eligibility','slug'=>'visa_considered','value'=>'Visa considered'],
			['name'=>'employment_eligibility','slug'=>'sponsorship_offered','value'=>'Sponsorship offered'],
			['name'=>'currency','slug'=>'pounds','value'=>'GBP Pound'],
			['name'=>'currency','slug'=>'dollars','value'=>'USD'],
			['name'=>'job_type','slug'=>'full_time','value'=>'Full Time'],
			['name'=>'job_type','slug'=>'contract_basis','value'=>'Contract Basis'],
			['name'=>'job_type','slug'=>'part_time','value'=>'Part Time'],
			['name'=>'job_type','slug'=>'graduate','value'=>'Graduate'],
			['name'=>'job_type','slug'=>'public_sector','value'=>'Public Sector'],
			['name'=>'job_type','slug'=>'work_from_home','value'=>'Work From Home'],

			['name'=>'job_distance','slug'=>'5','value'=>'5 Miles'],
			['name'=>'job_distance','slug'=>'10','value'=>'10 Miles'],
			['name'=>'job_distance','slug'=>'25','value'=>'25 Miles'],
			['name'=>'job_distance','slug'=>'50','value'=>'50 Miles'],
			['name'=>'job_distance','slug'=>'100','value'=>'100 Miles'],
			['name'=>'job_distance','slug'=>'national','value'=>'National'],

			['name'=>'job_posted','slug'=>'7','value'=>'Within 7 days'],
			['name'=>'job_posted','slug'=>'30','value'=>'Within 30 days'],
			['name'=>'job_posted','slug'=>'60','value'=>'Within 60 days'],
			['name'=>'job_posted','slug'=>'90','value'=>'Within 90 days'],
			['name'=>'job_posted','slug'=>'1','value'=>'Today'],
			['name'=>'sorted_by','slug'=>'best_match','value'=>'Best Match'],
			['name'=>'sorted_by','slug'=>'latest','value'=>'Latest'],
			['name'=>'salary_range','slug'=>'not_stated','value'=>'Not stated'],
			['name'=>'salary_range','slug'=>'below_15000','value'=>'Below £15,000'],
			['name'=>'salary_range','slug'=>'15000-20000','value'=>'£15,000 - £20,000 '],
			['name'=>'salary_range','slug'=>'20000-25000','value'=>'£20,000 - £25,000'],
			['name'=>'salary_range','slug'=>'25000-30000','value'=>'£25,000 - £30,000'],
			['name'=>'salary_range','slug'=>'30000-40000','value'=>'£30,000 - £40,000'],
			['name'=>'salary_range','slug'=>'40000-50000','value'=>'£40,000 - £50,000'],
			['name'=>'salary_range','slug'=>'50000-75000','value'=>'£50,000 - £75,000'],
			['name'=>'salary_range','slug'=>'75000-100000','value'=>'£75,000 - £100,000'],
			['name'=>'salary_range','slug'=>'above_100000','value'=>'Above £100,000'],
			['name'=>'hourly_rate','slug'=>'not_stated','value'=>'Not stated'],
			['name'=>'hourly_rate','slug'=>'below_10','value'=>'Below £10'],
			['name'=>'hourly_rate','slug'=>'10-20','value'=>'£10 - £20'],
			['name'=>'hourly_rate','slug'=>'20-30','value'=>'£20 - £30'],
			['name'=>'hourly_rate','slug'=>'30-40','value'=>'£30 - £40'],
			['name'=>'hourly_rate','slug'=>'40-50','value'=>'£40 - £50'],
			['name'=>'hourly_rate','slug'=>'50-75','value'=>'£50 - £75'],
			['name'=>'hourly_rate','slug'=>'75-100','value'=>'£75 - £100'],
			['name'=>'salary_type','slug'=>'annually','value'=>'Annually'],
			['name'=>'salary_type','slug'=>'hourly','value'=>'Hourly'],
			['name'=>'advert_days','slug'=>'30','value'=>'30 Days'],
			['name'=>'advert_days','slug'=>'60','value'=>'60 Days'],
			['name'=>'advert_days','slug'=>'90','value'=>'90 Days'],

		];
		\DB::table('dropdowns')->insert($dropdowns);
	}
}
