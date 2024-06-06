<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{   

    private Category $categoryModel;

    public function __construct(Category $category)
    {
        $this->categoryModel = $category;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $categories = $this->categoryModel->paginate(10);
        return view('admin.categories.index', ['categories'=> $categories]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        return view('admin.categories.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        
        $data = $request->all();

        $this->categoryModel->create($data);

        return redirect()->route('admin.categories.index')->with('success', 'Categoria criada com sucesso');

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
        
       $category = $this->categoryModel->findOrFail($id);
       return view('admin.categories.edit', ['category'=> $category]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id)
    {
        $category = $this->categoryModel->findOrFail($id);
        $data = $request->all();

        $category->update($data);

        return redirect()->route('admin.categories.index')->with('success', 'Categoria atualizada com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
        $category = $this->categoryModel->findOrFail($id);
        $category->delete();

        return redirect()->route('admin.categories.index')->with('warning', 'Categoria deletada com sucesso');

    }
}
