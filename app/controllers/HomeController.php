<?php

class HomeController extends BaseController {

    public function index() {
        $posts = Post::onlyPublish();
        if (Request::ajax()) {
            return Response::json(View::make('User.ajax_post', array('posts' => $posts))->render());
        }
        return View::make('User.home')->withPosts($posts);
    }

    public function single($id) {
        $posts = Post::where('status', '=', '1')->findOrFail($id);
        return View::make('User.single')->withPost($posts);
    }

}
