<?php

class Order extends Eloquent {

	protected $table = 'ordered_items';

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = ['id', 'account_id', 'item_id', 'quantity'];

	public function account() {
		return $this->belongsTo('Account');
	}

	public function shop() {
		return $this->belongsTo('Shop', 'item_id');
	}
}