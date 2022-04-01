<?php

namespace App\Http\Controllers;

use App\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add($productId)
    {
        $product = Product::findOrFail($productId);

        Cart::add($product->id, $product->title, 1, $product->price);

        return redirect()->back();
    }
}
