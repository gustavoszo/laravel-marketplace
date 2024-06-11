<?php

namespace App\Traits;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

trait Slug {

    // Mutator
    // O método setNameAttribute no modelo Product será acionado sempre que o atributo name do modelo for definido ou alterado.
    // $product = new Product(['name' => 'Nome do Produto']);
    // $product->name = 'Nome do Produto';
    public function setNameAttribute($value)    
    {
        $slug = Str::slug($value, '-');
        $matches = $this->uniqueSlug($slug);

        $this->attributes['name'] = $value;
        $this->attributes['slug'] =  $matches ? $slug. '-' . $matches : $slug;
    }

    public function uniqueSlug($slug) 
    {
        $matches = $this->whereRaw("slug REGEXP '^{$slug}(-[0-9]*)?$'")->count();

        return $matches;
    }    

}