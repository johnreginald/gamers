<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class PostsTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 5) as $index)
		{
			Post::create([
				'title' => 'Post ' .$faker->randomDigit,
				'author' => 'john',
				'content' => $faker->text,
				'status' => 1,
			]);

			Post::create([
				'title' => 'Drafted Post ' . $faker->randomDigit,
				'author' => 'john',
				'content' => $faker->text,
				'status' => 0,
			]);					
		}
	}

}