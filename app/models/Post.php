<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Post extends \Eloquent {

    use SoftDeletingTrait;

    protected $dates = ['deleted_at'];

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = ['title', 'content', 'status', 'author'];

	public static function onlyPublish() {
		return Post::where('status', '=', '1')->orderby('updated_at', 'desc')->get();
	}

	public static function onlyDraft() {
		return Post::where('status', '=', '0')->orderby('updated_at', 'desc')->get();
	}

	public static function changeStatus($id) {
		return ($id > 0) ? 'Publish' : 'Draft';
	}

	public static function search($name) {
		return Post::where('status', '=', '1')
					->orWhere('title', 'LIKE', '%' . $name . '%')
					->get();
	}

}