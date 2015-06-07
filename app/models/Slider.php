<?php

class Slider extends Eloquent {

	protected $table = 'slider';

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	// protected $fillable = ['id', 'account_id', 'item_id', 'quantity'];

}