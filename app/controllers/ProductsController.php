<?php

class ProductsController extends \BaseController {

    /**
     * Display a listing of products
     *
     * @return Response
     */
    public function index() {
        $products = Product::all();

        return View::make('Administrator.Product.index', compact('products'));
    }

    /**
     * Show the form for creating a new product
     *
     * @return Response
     */
    public function create() {
        return View::make('Administrator.Product.create');
    }

    /**
     * Store a newly created product in storage.
     *
     * @return Response
     */
    public function store() {
        $validator = Validator::make($data = Input::all(), Product::$rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        Product::create($data);

        return Redirect::action('ProductsController@index');
    }

    /**
     * Show the form for editing the specified product.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $product = Product::find($id);

        return View::make('Administrator.Product.edit', compact('product'));
    }

    /**
     * Update the specified product in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        $product = Product::findOrFail($id);

        $validator = Validator::make($data = Input::all(), Product::$rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $product->update($data);

        return Redirect::action('ProductsController@index');
    }

    /**
     * Remove the specified product from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        Product::destroy($id);
        Order::destroy($id);
        return Redirect::action('ProductsController@index');
    }

    /**
     * Shop's Functions
     */
    public function detail($id) {
        $product = Product::findOrFail($id);
        return View::make('User.product_single', compact('product'));
    }

    public function the_shop() {
        $products = Product::All();
        return View::make('User.shop', compact('products'));
    }

    public function add_item() {
        $item_id = Input::get('id') / 51235; // Real Item ID

        $item = Product::findOrFail($item_id);

        if ($item) {
            Cart::add($item_id, $item->name, 1, $item->price);
            return Redirect::to('shop');
        }
    }

    public function shopping_cart() {
        $cart = Cart::content();
        return View::make('User.shopping_cart', compact('cart'));
    }

    public function checkout() {
        // Checkout and Save Ordered Items in Database
        foreach (Cart::content() as $c) {
            // Save Order
            $order = new Order;
            $order->account_id = Auth::id();
            $order->item_id = $c->id;
            $order->quantity = $c->qty;
            $order->save();
        }
        // Remove Credit to Account
        $account = Account::find(Auth::id());
        If ($account->credit >= Cart::total()) {
            $account->credit = $account->credit - Cart::total();
            $account->save();
            Cart::destroy();
            return Redirect::to('dashboard')->withMessage(Lang::get('message.shop-success'))->withStatus('success');
        } else {
            return Redirect::to('shopping-cart')->withMessage(Lang::get('message.shop-fail'))->withStatus('danger');
        }
    }
    
    public function clear_cart(){
        Cart::destroy();
        return Redirect::to('shop');
    }
}
