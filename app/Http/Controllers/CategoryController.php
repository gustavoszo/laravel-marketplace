<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    
    private $category;

    public function __construct(Category $category) 
    {   
        $this->category = $category;
    }

    public function index($slug)
    {   

        $category = $this->category->where('slug', $slug)->first();

        return view('category', ['category'=> $category]);

    }

}
