<?php

class ShopsController extends \BaseController {

	/**
	 * Display a listing of shops
	 *
	 * @return Response
	 */
	public function index()
	{
		$shops = Shop::all();

		return View::make('Administrator.Shop.index', compact('shops'));
	}

	/**
	 * Show the form for creating a new shop
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('Administrator.Shop.create');
	}

	/**
	 * Store a newly created shop in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Shop::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Shop::create($data);

		return Redirect::action('ShopsController@index');
	}

	/**
	 * Display the specified shop.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$shop = Shop::findOrFail($id);

		return View::make('Administrator.Shop.show', compact('shop'));
	}

	/**
	 * Show the form for editing the specified shop.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$shop = Shop::find($id);

		return View::make('Administrator.Shop.edit', compact('shop'));
	}

	/**
	 * Update the specified shop in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$shop = Shop::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Shop::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$shop->update($data);

		return Redirect::action('ShopsController@index');
	}

	/**
	 * Remove the specified shop from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Shop::destroy($id);

		return Redirect::action('ShopsController@index');
	}

	/**
	 * Shop's Functions
	 */

	public function the_shop() {

		$shop = Shop::All();
		return View::make('User.shop', compact('shop'));

	}

	public function add_item() {
		$item_id = Input::get('id') / 51235; // Real Item ID

		$item = Shop::findOrFail($item_id);

		if ($item) {
			Cart::add($item_id, $item->name, 1, $item->price);
			return Redirect::to('shop');
		}

	}

	public function shopping_cart() {

		// Show Shopping Cart

		$cart = Cart::content();
    	return View::make('User.shopping_cart', compact('cart')); 

	}

	public function checkout() {
		
		// Checkout and Register Ordered Items in Database
		foreach (Cart::content() as $c) {
			$order = new Order;
			$order->account_id = Auth::id();
			$order->item_id = $c->id;
			$order->quantity = $c->qty;
			$order->save();
		}
		Cart::destroy();
		echo "Success";

	}

}
