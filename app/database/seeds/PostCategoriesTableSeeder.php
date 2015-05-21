<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class PostCategoriesTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 10) as $index)
		{
			PostCategory::create([
				'name' => 'Category ' . $faker->randomDigit,
				'slug' => strtolower(str_replace(' ', '-', 'Category ' . $faker->randomDigit)),
				'description' => $faker->text,
			]);
		}
	}

}