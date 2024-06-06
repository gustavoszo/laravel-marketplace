<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'body', 'price', 'slug'];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value, '-');
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
