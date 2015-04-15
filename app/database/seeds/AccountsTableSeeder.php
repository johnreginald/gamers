<?php

class AccountsTableSeeder extends Seeder {

	public function run()
	{
		{
			Account::create([
				'username' => 'john',
				'password' => Hash::make('1234'),
				'email' => 'johnthelinux@gmail.com'
			]);
		}
	}

}