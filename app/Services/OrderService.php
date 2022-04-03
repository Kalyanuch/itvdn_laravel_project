<?php

namespace App\Services;

use App\Order;
use App\OrderItem;
use App\User;
use Gloudemans\Shoppingcart\Facades\Cart;

class OrderService
{
    public function createOrder(CreateOrderRequest $request)
    {
        $order = Order::create([
            'customerName' => $request->customerName,
            'customerLastName' => $request->customerLastName,
            'customerEmail' => $request->customerEmail,
            'customerPhone' => $request->customerPhone,
            'customerAddress' => $request->customerAddress,
            'comment' => $request->customerComment,
            'total' => Cart::total(),
        ]);

        foreach(Cart::content() as $product)
        {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product->model->id,
                'price' => $product->model->price,
                'quantity' => $product->qty,
            ]);
        }

        if($request->has('updateUser'))
        {
            $user = auth()->guest() ? User::where('email', $request->customerEmail) : auth()->user();

            if(!is_null($user))
            {
                $user->update([
                    'name' => $request->customerName,
                    'lastname' => $request->customerLastName,
                    'phone' => $request->customerPhone,
                    'address' => $request->customerAddress
                ]);

                $order->update([
                    'user_id' => $user->id
                ]);
            }
        }

        return $order;
    }
}
