<?php

class ResellerController extends \BaseController {

	public function index()
	{
		$products = Product::All();
		return View::make('User.reseller.reseller', compact('products'));		
	}

    public function new_product() {
        return View::make('User.reseller.new-product');
    }

    public function application() {
        $reseller = new Reseller;      
        $reseller->user_id = Sentry::getUser()->id;
        $reseller->username = Sentry::getUser()->username;
        $reseller->save();       
        return Redirect::to('dashboard')->withMessage('Thank You for Applying. We will reply soon.')->withStatus('success');
    }

    /* ===  Media Manager Functions === */

    public function upload_images() {
        // SAVE Image
        $file = Input::file('file');
        $uploadPath = public_path('uploads/reseller');
        $name = strtolower(str_replace(' ', '-', $file->getClientOriginalName()));
        $file->move($uploadPath, $name);

        // Response File Name
        $link = URL::to('uploads/reseller') . '/' . $name;
        return Response::json(array('link' => $link ));
    }

    /* === Post Releated Functions === */

    public function save() {
        $validator = Validator::make(Input::all(), Product::$rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $product = new Product;
        $product->name = Input::get('name');
        $product->price = Input::get('price');
        $product->description = Input::get('description');
        $product->status = 0;
        $product->reseller = Sentry::getUser()->id;
        $product->image = strtolower(str_replace(' ', '-', Input::file('image')->getClientOriginalName()));

        $file = Input::file('image');
        $name = strtolower(str_replace(' ', '-', $file->getClientOriginalName()));
        $file->move(public_path('uploads/products'), $name);

        $product->save();

        return Redirect::action('ResellerController@index')->withMessage('Your Product is Successfully Saved! Please Wait for Approval from Administrator.')->withStatus('success');    	
    }
}
