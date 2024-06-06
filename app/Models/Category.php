<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;
    

    protected $fillable = ['name', 'description', 'slug'];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value, '-');
    }

    public function products() 
    {
        // O laravel busca na tabela pivot (category_product) por convenção (nome do model na ordem alfabética (category, product)).
        return $this->belongsToMany(Product::class);
    }
}
