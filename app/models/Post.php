<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Post extends \Eloquent {

    use SoftDeletingTrait;

    protected $dates = ['deleted_at'];
    // Add your validation rules here
    public static $rules = [
            'title' => 'required',
            'author' => 'required'
    ];

    // Don't forget to fill this array
    protected $fillable = ['title', 'content', 'status', 'author'];

    public static function onlyPublish() {
        return Post::where('status', '=', '1')->orderby('updated_at', 'desc')->paginate(5);
    }

    public static function onlyDraft() {
        return Post::where('status', '=', '0')->orderby('updated_at', 'desc')->get();
    }

    public static function changeStatus($id) {
        return ($id > 0) ? 'Publish' : 'Draft';
    }

    public static function search($q) {
        return Post::where('title', 'LIKE', '%' . $q . '%')->orWhere('content', 'LIKE', '%' . $q . '%')->orWhere('author', 'LIKE', '%' . $q . '%')->get();
    }

    public static function readmore($id) {
        $post = Post::find($id);
        return (strlen($post->content) > 200) ? substr($post->content, 0, 200) . ' <a href="' . URL::to('post') . "/" . $id .'">Read More</a>' : $post->content;
    }

    // Relations with Categories
    public function categories()
    {
        return $this->belongsToMany('PostCategory', 'PostCategory_post', 'post_id', 'PostCategory_id');
    }

}
