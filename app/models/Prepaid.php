<?php

class Prepaid extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = ['serial', 'code', 'used_by', 'status'];

}