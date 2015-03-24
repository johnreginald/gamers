<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

  		$this->call('ContentsTableSeeder');
        $this->command->info("Contents table seeded :)");

  		$this->call('ShopsTableSeeder');
        $this->command->info("Shops table seeded :)");
	}

}
