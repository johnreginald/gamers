<?php

class Order extends \Eloquent {

	protected $table = 'ordered_items';

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = ['id', 'customer_id', 'item_id', 'quantity'];

}