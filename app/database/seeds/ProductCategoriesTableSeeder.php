<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class ProductCategoriesTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 5) as $index)
		{
			ProductCategory::create([
				'name' => 'Item Category',
				'description' => $faker->text,
			]);
		}
	}

}