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

  		$this->call('PostsTableSeeder');
        $this->command->info("Posts table seeded :)");

  		$this->call('AccountsTableSeeder');
        $this->command->info("Accounts table seeded :)");
	}

}
