<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Collective\Html\Eloquent\FormAccessible;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use FormAccessible, SoftDeletes;

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
