<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccount extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::create('accounts', function(Blueprint $table)
            {
                $table->increments('id');
                $table->string('username', 255)->unique('username');
                $table->string('password', 60);
                $table->string('email', 255)->unique('email');
                $table->timestamps();
                $table->rememberToken();
                $table->softDeletes();
            });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
            Schema::drop('accounts');
	}

}
