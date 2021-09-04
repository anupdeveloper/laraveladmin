<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	*/
	public function run() {

		\DB::table('permission_role')->delete();

		\DB::table('permissions')->delete();
		\DB::table('permissions')->insert([
			// Pending Customers
			[
				'name' => 'Add',
				'slug' => 'add_customer',
				'module_name' => 'Pending Customers',
				'module_slug' => 'pending_customers',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'Edit',
				'slug' => 'edit_pending_customer',
				'module_name' => 'Pending Customers',
				'module_slug' => 'pending_customers',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'Delete',
				'slug' => 'delete_pending_customer',
				'module_name' => 'Pending Customers',
				'module_slug' => 'pending_customers',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'View',
				'slug' => 'view_pending_customer',
				'module_name' => 'Pending Customers',
				'module_slug' => 'pending_customers',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'Whitelist',
				'slug' => 'whitelist_pending_customer',
				'module_name' => 'Pending Customers',
				'module_slug' => 'pending_customers',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'Reject',
				'slug' => 'reject_pending_customer',
				'module_name' => 'Pending Customers',
				'module_slug' => 'pending_customers',
				'description' => 'desc',
				'status' => 1
			],

			// Whitelisted Customers
			[
				'name' => 'Edit',
				'slug' => 'edit_whitelisted_customer',
				'module_name' => 'Whitelisted Customers',
				'module_slug' => 'whitelisted_customers',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'Delete',
				'slug' => 'delete_whitelisted_customer',
				'module_name' => 'Whitelisted Customers',
				'module_slug' => 'whitelisted_customers',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'View',
				'slug' => 'view_whitelisted_customer',
				'module_name' => 'Whitelisted Customers',
				'module_slug' => 'whitelisted_customers',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'Reject',
				'slug' => 'reject_whitelisted_customer',
				'module_name' => 'Whitelisted Customers',
				'module_slug' => 'whitelisted_customers',
				'description' => 'desc',
				'status' => 1
			],
			
			// Rejected Customers
			[
				'name' => 'Edit',
				'slug' => 'edit_rejected_customer',
				'module_name' => 'Rejected Customers',
				'module_slug' => 'rejected_customers',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'Delete',
				'slug' => 'delete_rejected_customer',
				'module_name' => 'Rejected Customers',
				'module_slug' => 'rejected_customers',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'View',
				'slug' => 'view_rejected_customer',
				'module_name' => 'Rejected Customers',
				'module_slug' => 'rejected_customers',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'Whitelist',
				'slug' => 'whitelist_rejected_customer',
				'module_name' => 'Rejected Customers',
				'module_slug' => 'rejected_customers',
				'description' => 'desc',
				'status' => 1
			],

			// Jobseeker
			[
				'name' => 'Add',
				'slug' => 'add_jobseeker',
				'module_name' => 'Jobseekers',
				'module_slug' => 'jobseekers',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'Edit',
				'slug' => 'edit_jobseeker',
				'module_name' => 'Jobseekers',
				'module_slug' => 'jobseekers',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'Delete',
				'slug' => 'delete_jobseeker',
				'module_name' => 'Jobseekers',
				'module_slug' => 'jobseekers',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'View',
				'slug' => 'view_jobseeker',
				'module_name' => 'Jobseekers',
				'module_slug' => 'jobseekers',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'View',
				'slug' => 'view_guest',
				'module_name' => 'Guests',
				'module_slug' => 'guests',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'View Resume',
				'slug' => 'view_guest_resume',
				'module_name' => 'Guests',
				'module_slug' => 'guests',
				'description' => 'desc',
				'status' => 1
			],
			// Recruiter
			/* [
				'name' => 'Add',
				'slug' => 'add_recruiter',
				'module_name' => 'Recruiters',
				'module_slug' => 'recruiters',
				'description' => 'desc',
				'status' => 1
			], */
			[
				'name' => 'Edit',
				'slug' => 'edit_recruiter',
				'module_name' => 'Recruiters',
				'module_slug' => 'recruiters',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'Delete',
				'slug' => 'delete_recruiter',
				'module_name' => 'Recruiters',
				'module_slug' => 'recruiters',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'View',
				'slug' => 'view_recruiter',
				'module_name' => 'Recruiters',
				'module_slug' => 'recruiters',
				'description' => 'desc',
				'status' => 1
			],
			// Admins
			[
				'name' => 'Add',
				'slug' => 'add_admin',
				'module_name' => 'Admins',
				'module_slug' => 'admins',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'Edit',
				'slug' => 'edit_admin',
				'module_name' => 'Admins',
				'module_slug' => 'admins',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'Delete',
				'slug' => 'delete_admin',
				'module_name' => 'Admins',
				'module_slug' => 'admins',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'View',
				'slug' => 'view_admin',
				'module_name' => 'Admins',
				'module_slug' => 'admins',
				'description' => 'desc',
				'status' => 1
			],
			// Jobs
			// [
			// 	'name' => 'Add',
			// 	'slug' => 'add_job',
			// 	'module_name' => 'Jobs',
			// 	'module_slug' => 'jobs',
			// 	'description' => 'desc',
			// 	'status' => 1
			// ],
			[
				'name' => 'Edit',
				'slug' => 'edit_job',
				'module_name' => 'Jobs',
				'module_slug' => 'jobs',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'Delete',
				'slug' => 'delete_job',
				'module_name' => 'Jobs',
				'module_slug' => 'jobs',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'View',
				'slug' => 'view_job',
				'module_name' => 'Jobs',
				'module_slug' => 'jobs',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'Suspend',
				'slug' => 'suspend_job',
				'module_name' => 'Jobs',
				'module_slug' => 'jobs',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'Resume',
				'slug' => 'resume_job',
				'module_name' => 'Suspended Jobs',
				'module_slug' => 'suspended_jobs',
				'description' => 'desc',
				'status' => 1
			],
			// Job History
			[
				'name' => 'View',
				'slug' => 'view_job_history',
				'module_name' => 'Job History',
				'module_slug' => 'job_history',
				'description' => 'desc',
				'status' => 1
			],
			// Company Credits
			// [
			// 	'name' => 'Add',
			// 	'slug' => 'add_company_credit',
			// 	'module_name' => 'Company Credits',
			// 	'module_slug' => 'company_credits',
			// 	'description' => 'desc',
			// 	'status' => 1
			// ],
			// [
			// 	'name' => 'View',
			// 	'slug' => 'view_company_credit',
			// 	'module_name' => 'Company Credits',
			// 	'module_slug' => 'company_credits',
			// 	'description' => 'desc',
			// 	'status' => 1
			// ],
			// Company Credit History
			// [
			// 	'name' => 'View',
			// 	'slug' => 'view_credits_history',
			// 	'module_name' => 'Credits History',
			// 	'module_slug' => 'credits_history',
			// 	'description' => 'desc',
			// 	'status' => 1
			// ],
			// Payment Transactions
			[
				'name' => 'View',
				'slug' => 'view_payment_transaction',
				'module_name' => 'Payment Transactions',
				'module_slug' => 'payment_transactions',
				'description' => 'desc',
				'status' => 1
			],
			// Tickets
			[
				'name' => 'View',
				'slug' => 'view_ticket',
				'module_name' => 'Tickets',
				'module_slug' => 'tickets',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'Reply',
				'slug' => 'reply_ticket',
				'module_name' => 'Tickets',
				'module_slug' => 'tickets',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'Open',
				'slug' => 'open_ticket',
				'module_name' => 'Tickets',
				'module_slug' => 'tickets',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'Close',
				'slug' => 'close_ticket',
				'module_name' => 'Tickets',
				'module_slug' => 'tickets',
				'description' => 'desc',
				'status' => 1
			],
			// Job Industries
			[
				'name' => 'Add',
				'slug' => 'add_job_industry',
				'module_name' => 'Job Industries',
				'module_slug' => 'job_industries',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'Edit',
				'slug' => 'edit_job_industry',
				'module_name' => 'Job Industries',
				'module_slug' => 'job_industries',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'Delete',
				'slug' => 'delete_job_industry',
				'module_name' => 'Job Industries',
				'module_slug' => 'job_industries',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'View',
				'slug' => 'view_job_industry',
				'module_name' => 'Job Industries',
				'module_slug' => 'job_industries',
				'description' => 'desc',
				'status' => 1
			],
			// Job Qualifications
			[
				'name' => 'Add',
				'slug' => 'add_job_qualification',
				'module_name' => 'Job Qualifications',
				'module_slug' => 'job_qualifications',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'Edit',
				'slug' => 'edit_job_qualification',
				'module_name' => 'Job Qualifications',
				'module_slug' => 'job_qualifications',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'Delete',
				'slug' => 'delete_job_qualification',
				'module_name' => 'Job Qualifications',
				'module_slug' => 'job_qualifications',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'View',
				'slug' => 'view_job_qualification',
				'module_name' => 'Job Qualifications',
				'module_slug' => 'job_qualifications',
				'description' => 'desc',
				'status' => 1
			],
			// Job Locations
			[
				'name' => 'Add',
				'slug' => 'add_job_location',
				'module_name' => 'Job Locations',
				'module_slug' => 'job_locations',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'Edit',
				'slug' => 'edit_job_location',
				'module_name' => 'Job Locations',
				'module_slug' => 'job_locations',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'Delete',
				'slug' => 'delete_job_location',
				'module_name' => 'Job Locations',
				'module_slug' => 'job_locations',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'View',
				'slug' => 'view_job_location',
				'module_name' => 'Job Locations',
				'module_slug' => 'job_locations',
				'description' => 'desc',
				'status' => 1
			],
			// Skills
			[
				'name' => 'Add',
				'slug' => 'add_skill',
				'module_name' => 'Skills',
				'module_slug' => 'skills',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'Edit',
				'slug' => 'edit_skill',
				'module_name' => 'Skills',
				'module_slug' => 'skills',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'Delete',
				'slug' => 'delete_skill',
				'module_name' => 'Skills',
				'module_slug' => 'skills',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'View',
				'slug' => 'view_skill',
				'module_name' => 'Skills',
				'module_slug' => 'skills',
				'description' => 'desc',
				'status' => 1
			],
			// Cities
			[
				'name' => 'Add',
				'slug' => 'add_city',
				'module_name' => 'Cities',
				'module_slug' => 'cities',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'Edit',
				'slug' => 'edit_city',
				'module_name' => 'Cities',
				'module_slug' => 'cities',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'Delete',
				'slug' => 'delete_city',
				'module_name' => 'Cities',
				'module_slug' => 'cities',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'View',
				'slug' => 'view_city',
				'module_name' => 'Cities',
				'module_slug' => 'cities',
				'description' => 'desc',
				'status' => 1
			],
			// Counties
			[
				'name' => 'Add',
				'slug' => 'add_county',
				'module_name' => 'Counties',
				'module_slug' => 'counties',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'Edit',
				'slug' => 'edit_county',
				'module_name' => 'Counties',
				'module_slug' => 'counties',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'Delete',
				'slug' => 'delete_county',
				'module_name' => 'Counties',
				'module_slug' => 'counties',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'View',
				'slug' => 'view_county',
				'module_name' => 'Counties',
				'module_slug' => 'counties',
				'description' => 'desc',
				'status' => 1
			],
			// Roles
			[
				'name' => 'Add',
				'slug' => 'add_role',
				'module_name' => 'Roles',
				'module_slug' => 'roles',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'Edit',
				'slug' => 'edit_role',
				'module_name' => 'Roles',
				'module_slug' => 'roles',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'Delete',
				'slug' => 'delete_role',
				'module_name' => 'Roles',
				'module_slug' => 'roles',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'View',
				'slug' => 'view_role',
				'module_name' => 'Roles',
				'module_slug' => 'roles',
				'description' => 'desc',
				'status' => 1
			],
			// Permissions
			[
				'name' => 'Add',
				'slug' => 'add_permissions',
				'module_name' => 'Permissions',
				'module_slug' => 'permissions',
				'description' => 'desc',
				'status' => 1
			],
			// Recycle Bin
			[
				'name' => 'Restore Customers',
				'slug' => 'restore_customers',
				'module_name' => 'Restore',
				'module_slug' => 'recycle_bin',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'Permanent Delete Customers',
				'slug' => 'permanent_delete_customers',
				'module_name' => 'Permanent Delete',
				'module_slug' => 'recycle_bin',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'Restore Jobseekers',
				'slug' => 'restore_jobseekers',
				'module_name' => 'Restore',
				'module_slug' => 'recycle_bin',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'Permanent Delete Jobseekers',
				'slug' => 'permanent_delete_jobseekers',
				'module_name' => 'Permanent Delete',
				'module_slug' => 'recycle_bin',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'Restore Recruiters',
				'slug' => 'restore_recruiters',
				'module_name' => 'Restore',
				'module_slug' => 'recycle_bin',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'Permanent Delete Recruiters',
				'slug' => 'permanent_delete_recruiters',
				'module_name' => 'Permanent Delete',
				'module_slug' => 'recycle_bin',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'Restore Admins',
				'slug' => 'restore_admins',
				'module_name' => 'Restore',
				'module_slug' => 'recycle_bin',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'Permanent Delete Admins',
				'slug' => 'permanent_delete_admins',
				'module_name' => 'Permanent Delete',
				'module_slug' => 'recycle_bin',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'Restore Jobs',
				'slug' => 'restore_jobs',
				'module_name' => 'Restore',
				'module_slug' => 'recycle_bin',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'Permanent Delete Jobs',
				'slug' => 'permanent_delete_jobs',
				'module_name' => 'Permanent Delete',
				'module_slug' => 'recycle_bin',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'Restore Job Industries',
				'slug' => 'restore_job_industries',
				'module_name' => 'Restore',
				'module_slug' => 'recycle_bin',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'Permanent Delete Job Industries',
				'slug' => 'permanent_delete_job_industries',
				'module_name' => 'Permanent Delete',
				'module_slug' => 'recycle_bin',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'Restore Job Qualifications',
				'slug' => 'restore_job_qualifications',
				'module_name' => 'Restore',
				'module_slug' => 'recycle_bin',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'Permanent Delete Job Qualifications',
				'slug' => 'permanent_delete_job_qualifications',
				'module_name' => 'Permanent Delete',
				'module_slug' => 'recycle_bin',
				'description' => 'desc',
				'status' => 1
			],
			// [
			// 	'name' => 'Restore Job Locations',
			// 	'slug' => 'restore_job_locations',
			// 	'module_name' => 'Restore',
			// 	'module_slug' => 'recycle_bin',
			// 	'description' => 'desc',
			// 	'status' => 1
			// ],
			// [
			// 	'name' => 'Permanent Delete Job Locations',
			// 	'slug' => 'permanent_delete_job_locations',
			// 	'module_name' => 'Permanent Delete',
			// 	'module_slug' => 'recycle_bin',
			// 	'description' => 'desc',
			// 	'status' => 1
			// ],
			[
				'name' => 'Restore Skills',
				'slug' => 'restore_skills',
				'module_name' => 'Restore',
				'module_slug' => 'recycle_bin',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'Permanent Delete Skills',
				'slug' => 'permanent_delete_skills',
				'module_name' => 'Permanent Delete',
				'module_slug' => 'recycle_bin',
				'description' => 'desc',
				'status' => 1
			],
			// [
			// 	'name' => 'Restore Cities',
			// 	'slug' => 'restore_cities',
			// 	'module_name' => 'Restore',
			// 	'module_slug' => 'recycle_bin',
			// 	'description' => 'desc',
			// 	'status' => 1
			// ],
			// [
			// 	'name' => 'Permanent Delete Cities',
			// 	'slug' => 'permanent_delete_cities',
			// 	'module_name' => 'Permanent Delete',
			// 	'module_slug' => 'recycle_bin',
			// 	'description' => 'desc',
			// 	'status' => 1
			// ],
			// [
			// 	'name' => 'Restore Counties',
			// 	'slug' => 'restore_counties',
			// 	'module_name' => 'Restore',
			// 	'module_slug' => 'recycle_bin',
			// 	'description' => 'desc',
			// 	'status' => 1
			// ],
			// [
			// 	'name' => 'Permanent Delete Counties',
			// 	'slug' => 'permanent_delete_counties',
			// 	'module_name' => 'Permanent Delete',
			// 	'module_slug' => 'recycle_bin',
			// 	'description' => 'desc',
			// 	'status' => 1
			// ],
			[
				'name' => 'Restore Roles',
				'slug' => 'restore_roles',
				'module_name' => 'Restore',
				'module_slug' => 'recycle_bin',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'Permanent Delete Roles',
				'slug' => 'permanent_delete_roles',
				'module_name' => 'Permanent Delete',
				'module_slug' => 'recycle_bin',
				'description' => 'desc',
				'status' => 1
			],
			
			// Pages
			[
				'name' => 'Edit',
				'slug' => 'edit_website_page',
				'module_name' => 'Website Pages',
				'module_slug' => 'website_pages',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'View',
				'slug' => 'view_website_page',
				'module_name' => 'Website Pages',
				'module_slug' => 'website_pages',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'Edit',
				'slug' => 'edit_mobile_page',
				'module_name' => 'Mobile Pages',
				'module_slug' => 'mobile_pages',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'View',
				'slug' => 'view_mobile_page',
				'module_name' => 'Mobile Pages',
				'module_slug' => 'mobile_pages',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'View',
				'slug' => 'view_feedback',
				'module_name' => 'Feedback',
				'module_slug' => 'feedback',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'View',
				'slug' => 'view_contact_us',
				'module_name' => 'Contact Us',
				'module_slug' => 'contact_us',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'View',
				'slug' => 'view_job_bookmarks',
				'module_name' => 'Bookmarks',
				'module_slug' => 'bookmarks',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'View',
				'slug' => 'view_job_applications',
				'module_name' => 'Job Applications',
				'module_slug' => 'job_applications',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'View',
				'slug' => 'view_job_search_history',
				'module_name' => 'Job Search History',
				'module_slug' => 'job_search_history',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'View',
				'slug' => 'view_reported_job',
				'module_name' => 'Reported Jobs',
				'module_slug' => 'reported_jobs',
				'description' => 'desc',
				'status' => 1
			],
			[
				'name' => 'View',
				'slug' => 'view_viewed_job',
				'module_name' => 'Viewed Jobs',
				'module_slug' => 'viewed_jobs',
				'description' => 'desc',
				'status' => 1
			],
		]);
		
		$allPermissions = \DB::table('permissions')->get();
		for($i=0; $i < count($allPermissions); $i++) {
			$permission = $allPermissions[$i];
			\DB::table('permission_role')->insert([
				'permission_id' => $permission->id,
				'role_id' => 1
			]);
		}

		$allAdminPermissions = \DB::table('permissions')->where('module_slug', '!=', 'roles')->where('module_slug', '!=', 'permissions')->get();
		for($i=0; $i < count($allAdminPermissions); $i++) {
			$permission = $allAdminPermissions[$i];
			\DB::table('permission_role')->insert([
				'permission_id' => $permission->id,
				'role_id' => 2
			]);
		}

		$allViewerPermissions = \DB::table('permissions')->where('name', 'View')->get();
		for($i=0; $i < count($allViewerPermissions); $i++) {
			$permission = $allViewerPermissions[$i];
			\DB::table('permission_role')->insert([
				'permission_id' => $permission->id,
				'role_id' => 3
			]);
		}

	}
}
