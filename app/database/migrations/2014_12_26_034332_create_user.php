<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUser extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::create('users', function(Blueprint $table)
            {
                $table->increments('id');
                $table->string('username', 255)->unique('username');
                $table->string('password', 60);
                $table->string('email', 255)->unique('email');
                $table->timestamps();
                $table->rememberToken();
            });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
            Schema::drop('users');
	}

}
