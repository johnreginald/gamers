<?php

class Advertisement extends Eloquent {

	protected $table = 'advertisements';

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	// protected $fillable = ['id', 'account_id', 'item_id', 'quantity'];

}