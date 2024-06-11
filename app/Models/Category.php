<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Slug;

class Category extends Model
{
    use Slug;
    use HasFactory;

    protected $fillable = ['name', 'description', 'slug'];

    public function products() 
    {
        // O laravel busca na tabela pivot (category_product) por convenção (nome do model na ordem alfabética (category, product)).
        return $this->belongsToMany(Product::class);
    }
}
