<?php

class HomeController extends BaseController {

    public function index() {
	    $contents = Post::type('post')->published()->get();
        return View::make('User.home', compact('contents'));
    }

}
