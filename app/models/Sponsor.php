<?php

class Sponsor extends Eloquent {

	protected $table = 'sponsor';

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	// protected $fillable = ['id', 'account_id', 'item_id', 'quantity'];

}