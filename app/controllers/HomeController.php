<?php

class HomeController extends BaseController {

    public function index() {
        $posts = Post::onlyPublish();
        return View::make('User.home')->withPosts($posts);
    }
    
    public function single($id) {
        $posts = Post::findOrFail($id);
        return View::make('User.single')->withPost($posts);
    }
}
