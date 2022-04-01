<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrderRequest;
use App\Order;
use App\User;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateOrderRequest $request)
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

        $request->session()->put('order_info', $order);

        return redirect()->route('cart.checkout.success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
