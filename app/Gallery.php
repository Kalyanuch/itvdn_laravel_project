<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = ['product_id', 'photos'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
