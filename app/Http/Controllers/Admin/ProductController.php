<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;
use App\Traits\UploadTrait;

class ProductController extends Controller
{

    use UploadTrait;
    
    private Product $productModel;

    public function __construct(Product $product) 
    {
        $this->productModel = $product;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $userStore = auth()->user()->store;
        $products = $userStore->products()->paginate(10);

        return view('admin.products.index', ['products'=> $products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $categories = Category::all(['id', 'name']);

        return view('admin.products.create', ['categories'=> $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {

        $data = $request->all();
        $categories = $request->get('categories', null);

        $store = auth()->user()->store;
        $product = $store->products()->create($data);

        $product->categories()->sync($categories);

        if ($request->hasFile('photos')) {

            $images = $this->imageUpload($request->file('photos'), 'image');

            $product->photos()->createMany($images);
            
        }

        return redirect()->route('admin.products.index')->with('success', 'Produto criado com sucesso');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = $this->productModel::findOrFail($id);
        $categories = Category::all(['id', 'name']);

        return view('admin.products.edit', ['product'=> $product, 'categories'=> $categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, string $id)
    {
        
        $data = $request->all();
        $categories = $request->get('categories', null);

        $product = $this->productModel->find($id);
        $product->update($data);

        if (!is_null($categories)) $product->categories()->sync($data['categories']);

        if ($request->hasFile('photos')) {

            $images = $this->imageUpload($request->file('photos'));

            $product->photos()->createMany($images);
            
        }
        
        return redirect()->route('admin.products.index')->with('success', 'Produto atualizado com sucesso');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
        $product = $this->productModel->find($id);
        $product->delete();

        return redirect()->route('admin.products.index')->with('warning', 'Produto deletado com sucesso');

    }

}
