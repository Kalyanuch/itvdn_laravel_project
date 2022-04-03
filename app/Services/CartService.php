<?php

namespace App\Services;

use App\Http\Requests\CartDropItemRequest;
use App\Http\Requests\CartUpdateRequest;
use App\Product;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartService
{
    public function addProduct(int $productId)
    {
        $product = Product::findOrFail($productId);

        Cart::add($product->id, $product->title, 1, $product->price)->associate(Product::class);
    }

    public function updateCart(CartUpdateRequest $request)
    {
        Cart::update($request->productId, $request->qty);
    }

    public function dropProduct(CartDropItemRequest $request)
    {
        Cart::remove($request->productId);
    }

    public function clearCart()
    {
        Cart::destroy();
    }
}
