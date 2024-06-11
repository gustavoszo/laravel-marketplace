<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    
    private $store;

    public function __construct(Store $store) 
    {   
        $this->store = $store;
    }

    public function index(Request $request, $slug)
    {

        $categorySlug = $request->query('category');

        $store = $this->store->where('slug', $slug)->first();

        $productsCategory = [];
        if(isset($categorySlug)) {

            $productsCategory = $store->products()->whereHas('categories', function($query) use($categorySlug) {
                $query->where('categories.slug', $categorySlug);
            })->get(); 

        } 

        return view('store', ['store'=> $store, 'productsByStoreCategory'=> $productsCategory]);

    }

}
