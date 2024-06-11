<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Slug;

class Product extends Model
{

    use Slug;
    use HasFactory;

    protected $fillable = ['name', 'description', 'body', 'price', 'slug'];

    // Accessor
    // $product->thumb
    public function getThumbAttribute()
    {
        return $this->photos->first()->image;
    }
    
    public function store() 
    {
        return $this->belongsTo(Store::class);
    }

    public function categories() 
    {
        // O laravel busca na tabela pivot (category_product) por convenção (nome do model na ordem alfabética (category, product)).
        return $this->belongsToMany(Category::class);
    }

    public function photos() {
        return $this->hasMany(ProductPhoto::class);
    }

}
