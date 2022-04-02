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

        Cart::add($product->id, $product->title, 1, $product->price)->associate(Product::class);

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
        if(Cart::count() == 0)
            return redirect()->route('cart.index');

        return view('cart.checkout');
    }

    public function checkoutSuccess(Request $request)
    {
        if(Cart::count() == 0)
            return redirect()->route('cart.checkout');

        $order_info = $request->session()->get('order_info', null);

        $request->session()->remove('order_info');

        Cart::destroy();

        return view('cart.success', ['order_id' => $order_info->id, 'username' => $order_info->customerName]);
    }
}
