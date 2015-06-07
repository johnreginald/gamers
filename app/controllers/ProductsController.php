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
        $validator = Validator::make(Input::all(), Product::$rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $product = new Product;
        $product->name = Input::get('name');
        $product->price = Input::get('price');
        $product->description = Input::get('description');
        $product->image = strtolower(str_replace(' ', '-', Input::file('image')->getClientOriginalName()));

        $file = Input::file('image');
        $name = strtolower(str_replace(' ', '-', $file->getClientOriginalName()));
        $file->move(public_path('uploads/products'), $name);

        $product->save();

        return Redirect::action('ProductsController@edit', ['product' => $product->id])
            ->withProduct(Product::find($product->id))->withMessage('Successfully Saved!')->withStatus('success');
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
        $rules = [
            'name' => 'required',
            'price' => 'required|numeric',
        ];

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $product->name = Input::get('name');
        $product->price = Input::get('price');
        $product->description = Input::get('description');
        
        // Save Image
        if (Input::hasFile('image')) {
            $product->image = strtolower(str_replace(' ', '-', Input::file('image')->getClientOriginalName()));
            $file = Input::file('image');
            $name = strtolower(str_replace(' ', '-', $file->getClientOriginalName()));
            $file->move(public_path('uploads/products'), $name);
        }
        
        $product->save();

        return Redirect::action('ProductsController@edit', ['product' => $product->id])
            ->withProduct(Product::find($product->id))->withMessage('Successfully Saved!')->withStatus('success');
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
        $products = Product::paginate(9);
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
        // Remove Credit from Account
        $account = Account::find(Sentry::getUser()->id);
        if ($account->credit >= Cart::total()) {
            // Checkout and Save Ordered Items in Database
            foreach (Cart::content() as $c) {

                // Save Order
                $order = new Order;
                $order->account_id = Sentry::getUser()->id;
                $order->item_id = $c->id;
                $order->quantity = $c->qty;
                $order->save();

                $product = Product::findOrFail($order->item_id);

                Mail::send('emails.administrator.order', array(
                    'customer' => $account->username,
                    'product_name' => $product->name,
                    'quantity' => $c->qty
                    ), function($message)
                {
                    $message->to(Config::get('settings.admin-email'), 'Administrator')->subject('New Product Order');
                });

            }

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
