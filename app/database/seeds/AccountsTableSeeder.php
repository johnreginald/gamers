<?php

class AccountsTableSeeder extends Seeder {

	public function run()
	{
		{
			DB::table('users')->delete();
			
			Sentry::createUser([
				'username' => 'john',
				'password' => '1234',
				'email' => 'johnthelinux@gmail.com',
				'activated' => TRUE,
			]);
		}
	}

}