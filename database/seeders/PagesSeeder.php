<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PagesSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	*/
	public function run() {
		\DB::table('pages')->delete();
		\DB::table('pages')->insert([
			[
				'title' => 'Privacy Policy',
				'content' => "<strong>UK's Privacy Act</strong> provisions. If you are not a lawyer or someone who is familiar to Privacy Policies, you will be clueless. Some people might even take advantage of you because of this. Some people may even extort money from you. These are some examples that we want to stop from happening to you.</p>
				<p>We will help you protect yourself by generating a Privacy Policy.</p>
				<p><strong>Our Privacy Policy Generator can help you make sure that your business complies with the law.</strong> We are here to help you protect your business, yourself and your customers.</p>
				<p>Fill in the blank spaces below and we will create a personalized website Privacy Policy for your business. No account registration required. <strong>Simply generate &amp; download a Privacy Policy in seconds!</strong></p>
				<p><em>Small remark when filling in this Privacy Policy generator: Not all parts of this Privacy Policy might be applicable to your website. When there are parts that are not applicable, these can be removed. Optional elements can be selected in step 2. The accuracy of the generated Privacy Policy on this website is not legally binding. Use at your own risk.</em></p>",
				'section' => 'privacy_policy',
				'device_type' => 'web',
				'added_by_id' => 1,
				'updated_by_id' => 1,
                "created_at" => \Carbon\Carbon::now(),
                "last_updated_at" => \Carbon\Carbon::now(),
			],
			[
				'title' => 'Privacy Policy',
				'content' => "<strong>UK's Privacy Act</strong> provisions. If you are not a lawyer or someone who is familiar to Privacy Policies, you will be clueless. Some people might even take advantage of you because of this. Some people may even extort money from you. These are some examples that we want to stop from happening to you.</p>
				<p>We will help you protect yourself by generating a Privacy Policy.</p>
				<p><strong>Our Privacy Policy Generator can help you make sure that your business complies with the law.</strong> We are here to help you protect your business, yourself and your customers.</p>
				<p>Fill in the blank spaces below and we will create a personalized website Privacy Policy for your business. No account registration required. <strong>Simply generate &amp; download a Privacy Policy in seconds!</strong></p>
				<p><em>Small remark when filling in this Privacy Policy generator: Not all parts of this Privacy Policy might be applicable to your website. When there are parts that are not applicable, these can be removed. Optional elements can be selected in step 2. The accuracy of the generated Privacy Policy on this website is not legally binding. Use at your own risk.</em></p>",
				'section' => 'privacy_policy',
				'device_type' => 'mobile',
				'added_by_id' => 1,
				'updated_by_id' => 1,
                "created_at" => \Carbon\Carbon::now(),
                "last_updated_at" => \Carbon\Carbon::now(),
			],
			[
				'title' => 'Terms & Conditions',
				'content' => "<strong>What is the meaning of lorem ipsum?</strong>
				<p>Lorem ipsum is the most popular form of dummy content or placeholder text. It is a pseudo-Latin word originated from Cicero's De Finibus Bonorum et Malorum. There is no actual meaning of any Lorem Ipsum sentences even in Latin or any other language. Then...</p>
				<strong>What is the use of lorem ipsum?</strong>
				<p>Lorem ipsum text allows you to create title, paragraph or sentence instantly without having to write actual copy. It makes it possible to represent how a certain webpage, infographic, blog post would look like with a certain amount of content and gives a feel of the content. This placeholder text is designed in a way that it has no meaning to it which makes it flexible to be used anywhere.</p>
				<strong>Who uses lorem ipsum?</strong>
				<p>Designers &amp; webmasters use it to visualize existence of text form of content on websites, wireframes or posters. In most of the cases, the person who writes the content and design the page are two different people. Designers prefer to just put dummy content before the final version is ready to make sure you have the right font size, color, line height, font-family, etc.</p>
				<strong>Where can I get lorem ipsum dolor sit amet?</strong>
				<p>Use our free Lorem Ipsum Generator if you are looking for copyright free dummy content for your websites, mockups, wireframes and articles.</p>",
				'section' => 'terms_and_conditions',
				'device_type' => 'web',
				'added_by_id' => 1,
				'updated_by_id' => 1,
                "created_at" => \Carbon\Carbon::now(),
                "last_updated_at" => \Carbon\Carbon::now(),
			],
			[
				'title' => 'Terms & Conditions',
				'content' => "<strong>What is the meaning of lorem ipsum?</strong>
				<p>Lorem ipsum is the most popular form of dummy content or placeholder text. It is a pseudo-Latin word originated from Cicero's De Finibus Bonorum et Malorum. There is no actual meaning of any Lorem Ipsum sentences even in Latin or any other language. Then...</p>
				<strong>What is the use of lorem ipsum?</strong>
				<p>Lorem ipsum text allows you to create title, paragraph or sentence instantly without having to write actual copy. It makes it possible to represent how a certain webpage, infographic, blog post would look like with a certain amount of content and gives a feel of the content. This placeholder text is designed in a way that it has no meaning to it which makes it flexible to be used anywhere.</p>
				<strong>Who uses lorem ipsum?</strong>
				<p>Designers &amp; webmasters use it to visualize existence of text form of content on websites, wireframes or posters. In most of the cases, the person who writes the content and design the page are two different people. Designers prefer to just put dummy content before the final version is ready to make sure you have the right font size, color, line height, font-family, etc.</p>
				<strong>Where can I get lorem ipsum dolor sit amet?</strong>
				<p>Use our free Lorem Ipsum Generator if you are looking for copyright free dummy content for your websites, mockups, wireframes and articles.</p>",
				'section' => 'terms_and_conditions',
				'device_type' => 'mobile',
				'added_by_id' => 1,
				'updated_by_id' => 1,
                "created_at" => \Carbon\Carbon::now(),
                "last_updated_at" => \Carbon\Carbon::now(),
			],
		]);
	}
}
