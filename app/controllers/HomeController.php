<?php

class HomeController extends BaseController {

    public function index() {
        $data = array(
            'posts' => Post::onlyPublish(),
            'advertisements' => Advertisement::All(),
            'sponsors' => Sponsor::All(),
            'featured' => Product::orderby('created_at', 'desc')->take(3)->get(),
            );
        if (Request::ajax()) {
            return Response::json(View::make('User.ajax_post', array('posts' => $posts))->render());
        }
        return View::make('User.home', $data);
    }

    public function single($id) {
        $posts = Post::where('status', '=', '1')->findOrFail($id);
        return View::make('User.single')->withPost($posts);
    }

    public function categories($slug) {
        $categories = PostCategory::where('slug', '=', $slug)->first();
        return View::make('User.categories')->withCategories($categories);
    }
}
