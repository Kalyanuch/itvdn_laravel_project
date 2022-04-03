<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartDropItemRequest;
use App\Http\Requests\CartUpdateRequest;
use App\Services\CartService;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * @var CartService
     */
    private $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index()
    {
        return view('cart.index');
    }

    public function add($productId)
    {
        $this->cartService->addProduct($productId);

        return redirect()->back();
    }

    public function update(CartUpdateRequest $request)
    {
        $this->cartService->updateCart($request);

        return redirect()->route('cart.index');
    }

    public function destroy()
    {
        $this->cartService->clearCart();

        return redirect()->route('cart.index');
    }

    public function drop(CartDropItemRequest $request)
    {
        $this->cartService->dropProduct($request);

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
