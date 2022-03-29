<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'title', 'description', 'slug', 'price', 'barcode', 'stock', 'cover'
    ];
}
