<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = ['product_id', 'order_id', 'price', 'quantity'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
