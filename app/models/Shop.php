<?php

class Shop extends \Eloquent {

	protected $table = "shops";

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = ['name', 'price', 'description'];

}