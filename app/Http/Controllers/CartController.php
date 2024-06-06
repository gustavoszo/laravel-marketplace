<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function index()
    {

        $cart = session()->has('cart') ? session()->get('cart') : [];

        return view('cart', ['cart'=> $cart]);

    }
    
    public function add(Request $request)
    {

        $product = $request->get('product');

        if(session()->has('cart')) {

            $products = session()->get('cart');
            $slugProducts = array_column($products, 'slug');

            if (in_array($product['slug'], $slugProducts)) {

                $products = $this->productIncrement($product['slug'], $product['amount'], $products);

                session()->put('cart', $products);

            } else {
                session()->push('cart', $product);
            }

        } else {
            $products[] = $product;
            session()->put('cart', $products);
        }

        return redirect()->route('product.single', ['slug'=> $product['slug']])->with('success', 'Produto adicionado ao carrinho');

    } 

    public function remove($slug) 
    {

        if(! session()->has('cart')) {
            return redirect()->route('cart.index');
        }

        $products = session()->get('cart');

        $cart = array_filter($products, function($line) use($slug) {
            return $line['slug'] != $slug;
        });

        session()->put('cart', $cart);

        return redirect()->route('cart.index');

    }

    public function cancel() 
    {

        session()->forget('cart');

        return redirect()->route('cart.index');

    }
    
    private function productIncrement($slug, $amount, $products) 
    {

        $cart = array_map(function($line) use($slug, $amount) {
            if($line['slug'] == $slug) {

                $line['amount'] += $amount;

            }

            return $line;

        }, $products);

        return $cart;

    }

}
