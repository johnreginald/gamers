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
			$table->integer('customer_id');
			$table->integer('item_id');
			$table->integer('quantity');
			$table->boolean('completed');
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
