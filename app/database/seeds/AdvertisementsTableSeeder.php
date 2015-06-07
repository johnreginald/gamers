<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class AdvertisementsTableSeeder extends Seeder {

	public function run()
	{
		DB::table('advertisements')->delete();
		
		$faker = Faker::create();

		foreach(range(1, 10) as $index)
		{
			Advertisement::create([

			]);
		}
	}

}