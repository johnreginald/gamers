<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderedItems extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ordered_items', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('account_id');
			$table->integer('item_id');
			$table->integer('quantity');
			$table->boolean('status');
            $table->integer('total');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ordered_items');
	}

}
