<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class OrdersTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 5) as $index)
		{
			Order::create([
                            'account_id' => 1,
                            'item_id' => 1,
                            'quantity' => $faker->numberBetween(1, 5),
                            'status' => 0,
                            'total' => $faker->numberBetween(1000, 100000),
			]);
		}
	}

}