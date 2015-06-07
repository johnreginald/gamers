<?php

class Product extends \Eloquent {

    protected $table = "products";
    // Add your validation rules here
    public static $rules = [
            'name' => 'required',
            'price' => 'required|numeric',
            'image' => 'image',
    ];
    // Don't forget to fill this array
    protected $fillable = ['name', 'price', 'description', 'image'];

    public static function readmore($id) {
        $product = Product::find($id);
        return (strlen($product->description) > 100) ? substr($product->description, 0, 100) . ' <a href="' . URL::to('post') . "/" . $id . '">More Detail</a>' : $product->description;
    }

}
