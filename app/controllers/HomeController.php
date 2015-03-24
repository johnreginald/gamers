<?php

class HomeController extends BaseController {

    public function index() {
    	$contents = Content::All();
        return View::make('User.home', compact('contents'));
    }

}
