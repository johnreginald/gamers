<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class ShopsTableSeeder extends Seeder {

	public function run()
	{
		Shop::create(
			array(
				'name' => "Dota 2 - Item",
				'description' => "This is an Awesome Dota 2 Item", 
				'price' => '500',
				)
		);
	}

}