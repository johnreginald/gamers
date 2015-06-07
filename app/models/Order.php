<?php

class Order extends Eloquent {

	protected $table = 'ordered_items';

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = ['id', 'account_id', 'item_id', 'quantity', 'total'];
        
        public function product() {
            return $this->belongsTo('Product', 'item_id');
        }
        
        public function account() {
            return $this->belongsTo('Account', 'account_id');
        }
}