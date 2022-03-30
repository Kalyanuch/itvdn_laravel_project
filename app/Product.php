<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'title', 'description', 'slug', 'price', 'barcode', 'stock', 'cover'
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function gallery()
    {
        return $this->hasOne(Gallery::class);
    }
}
