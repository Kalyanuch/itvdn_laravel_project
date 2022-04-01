<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartDropItemRequest;
use App\Http\Requests\CartUpdateRequest;
use App\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        return view('cart.index');
    }

    public function add($productId)
    {
        $product = Product::findOrFail($productId);

        Cart::add($product->id, $product->title, 1, $product->price);

        return redirect()->back();
    }

    public function update(CartUpdateRequest $request)
    {
        Cart::update($request->productId, $request->qty);

        return redirect()->route('cart.index');
    }

    public function destroy()
    {
        Cart::destroy();

        return redirect()->route('cart.index');
    }

    public function drop(CartDropItemRequest $request)
    {
        Cart::remove($request->productId);

        return redirect()->route('cart.index');
    }

    public function checkout()
    {
        return view('cart.checkout');
    }
}
