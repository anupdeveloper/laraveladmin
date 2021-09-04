<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CountiesSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	*/
	public function run() {

		\DB::table('counties')->delete();

		$counties = [
			['town' => "",'county' => "Bedfordshire",'country' => "England"],
			['town' => "",'county' => "Berkshire",'country' => "England"],
			['town' => "",'county' => "Bristol",'country' => "England"],
			['town' => "",'county' => "Buckinghamshire",'country' => "England"],
			['town' => "",'county' => "Cambridgeshire",'country' => "England"],
			['town' => "",'county' => "Cheshire",'country' => "England"],
			['town' => "",'county' => "Cornwall",'country' => "England"],
			['town' => "",'county' => "County Durham",'country' => "England"],
			['town' => "",'county' => "Cumbria",'country' => "England"],
			['town' => "",'county' => "Derbyshire",'country' => "England"],
			['town' => "",'county' => "Devon",'country' => "England"],
			['town' => "",'county' => "Dorset",'country' => "England"],
			['town' => "",'county' => "East Riding of Yorkshire",'country' => "England"],
			['town' => "",'county' => "East Sussex",'country' => "England"],
			['town' => "",'county' => "Essex",'country' => "England"],
			['town' => "",'county' => "Gloucestershire",'country' => "England"],
			['town' => "",'county' => "Greater London",'country' => "England"],
			['town' => "",'county' => "Greater Manchester",'country' => "England"],
			['town' => "",'county' => "Hampshire",'country' => "England"],
			['town' => "",'county' => "Herefordshire",'country' => "England"],
			['town' => "",'county' => "Hertfordshire",'country' => "England"],
			['town' => "",'county' => "Isle of Wight",'country' => "England"],
			['town' => "",'county' => "Kent",'country' => "England"],
			['town' => "",'county' => "Lancashire",'country' => "England"],
			['town' => "",'county' => "Leicestershire",'country' => "England"],
			['town' => "",'county' => "Lincolnshire",'country' => "England"],
			['town' => "",'county' => "Merseyside",'country' => "England"],
			['town' => "",'county' => "Norfolk",'country' => "England"],
			['town' => "",'county' => "North Yorkshire",'country' => "England"],
			['town' => "",'county' => "Northamptonshire",'country' => "England"],
			['town' => "",'county' => "Northumberland",'country' => "England"],
			['town' => "",'county' => "Nottinghamshire",'country' => "England"],
			['town' => "",'county' => "Oxfordshire",'country' => "England"],
			['town' => "",'county' => "Rutland",'country' => "England"],
			['town' => "",'county' => "Shropshire",'country' => "England"],
			['town' => "",'county' => "Somerset",'country' => "England"],
			['town' => "",'county' => "South Yorkshire",'country' => "England"],
			['town' => "",'county' => "Staffordshire",'country' => "England"],
			['town' => "",'county' => "Suffolk",'country' => "England"],
			['town' => "",'county' => "Surrey",'country' => "England"],
			['town' => "",'county' => "Tyne and Wear",'country' => "England"],
			['town' => "",'county' => "Warwickshire",'country' => "England"],
			['town' => "",'county' => "West Midlands",'country' => "England"],
			['town' => "",'county' => "West Sussex",'country' => "England"],
			['town' => "",'county' => "West Yorkshire",'country' => "England"],
			['town' => "",'county' => "Wiltshire",'country' => "England"],
			['town' => "",'county' => "Worcestershire",'country' => "England"],
			['town' => "",'county' => "County Antrim",'country' => "Northern Ireland"],
			['town' => "",'county' => "County Armagh",'country' => "Northern Ireland"],
			['town' => "",'county' => "County Down",'country' => "Northern Ireland"],
			['town' => "",'county' => "County Fermanagh",'country' => "Northern Ireland"],
			['town' => "",'county' => "County Londonderry",'country' => "Northern Ireland"],
			['town' => "",'county' => "County Tyrone",'country' => "Northern Ireland"],
			['town' => "",'county' => "Aberdeenshire",'country' => "Scotland"],
			['town' => "",'county' => "Angus",'country' => "Scotland"],
			['town' => "",'county' => "Clackmannanshire",'country' => "Scotland"],
			['town' => "",'county' => "Dumfries and Galloway",'country' => "Scotland"],
			['town' => "",'county' => "Dundee",'country' => "Scotland"],
			['town' => "",'county' => "East Lothian",'country' => "Scotland"],
			['town' => "",'county' => "Edinburgh?",'country' => "Scotland"],
			['town' => "",'county' => "Falkirk",'country' => "Scotland"],
			['town' => "",'county' => "Fife",'country' => "Scotland"],
			['town' => "",'county' => "Highlands",'country' => "Scotland"],
			['town' => "",'county' => "Lothian",'country' => "Scotland"],
			['town' => "",'county' => "Moray",'country' => "Scotland"],
			['town' => "",'county' => "Perth and Kinross",'country' => "Scotland"],
			['town' => "",'county' => "Scottish Borders",'country' => "Scotland"],
			['town' => "",'county' => "Stirlingshire",'country' => "Scotland"],
			['town' => "",'county' => "Strathclyde",'country' => "Scotland"],
			['town' => "",'county' => "West Lothian",'country' => "Scotland"],
			['town' => "",'county' => "Western Isles",'country' => "Scotland"],
			['town' => "",'county' => "Anglesey",'country' => "Wales"],
			['town' => "",'county' => "Carmarthenshire",'country' => "Wales"],
			['town' => "",'county' => "Ceredigion",'country' => "Wales"],
			['town' => "",'county' => "Conwy",'country' => "Wales"],
			['town' => "",'county' => "Denbighshire",'country' => "Wales"],
			['town' => "",'county' => "Flintshire",'country' => "Wales"],
			['town' => "",'county' => "Gwent",'country' => "Wales"],
			['town' => "",'county' => "Gwynedd",'country' => "Wales"],
			['town' => "",'county' => "Mid Glamorgan",'country' => "Wales"],
			['town' => "",'county' => "Monmouthshire",'country' => "Wales"],
			['town' => "",'county' => "Pembrokeshire",'country' => "Wales"],
			['town' => "",'county' => "Powys",'country' => "Wales"],
			['town' => "",'county' => "South Glamorgan",'country' => "Wales"],
			['town' => "",'county' => "West Glamorgan",'country' => "Wales"],
			['town' => "",'county' => "Wrexham",'country' => "Wales"],
		];
		
		\DB::table('counties')->insert($counties);
	}
}
