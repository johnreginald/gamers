<?php

class PostCategory extends \Eloquent {

	protected $table = "PostCategories";

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = ['name', 'description'];

	// Relations with Categories
    public function posts()
    {
        return $this->belongsToMany('Post', 'PostCategory_post', 'PostCategory_id', 'post_id');
    }

}