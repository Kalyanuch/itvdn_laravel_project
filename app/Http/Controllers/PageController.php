<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        return view('welcome', [
            'products' => Product::orderBy('id', 'DESC')->take(12)->get()
        ]);
    }
}
