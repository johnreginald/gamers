<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class ProductsTableSeeder extends Seeder {

    public function run() {
        $faker = Faker::create();

        foreach (range(1, 10) as $index) {
            Product::create([
                'name' => "Item " . $faker->word,
                'description' => $faker->text,
                'price' => $faker->numberBetween(100, 10000),
                'image' => 'test',
            ]);
        }
    }

}
