<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // $products = Product::paginate(3);
        $products = Product::latest()->limit(8)->get();
        return view('index')->with('products', $products);
    }
}
