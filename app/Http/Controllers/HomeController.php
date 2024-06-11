<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    private $product;
    private $store;

    public function __construct(Product $product, Store $store)
    {
        $this->product = $product;
        $this->store = $store;
    }

    public function index()
    {
        
        $products = $this->product->orderByDesc('id')->paginate(9);
        return view('welcome', ['products'=> $products]);
        
    }

    public function single($slug)
    {
        
        $product = $this->product->where('slug', $slug)->first();

        return view('single', ['product'=> $product]);
        
    }
}
