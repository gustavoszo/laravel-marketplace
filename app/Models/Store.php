<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Slug;

class Store extends Model
{
    use Slug;
    use HasFactory;

    protected $fillable = ['name', 'description', 'phone', 'mobile_phone', 'slug', 'logo'];

    public function user() 
    {
        return $this->belongsTo(User::class);
    }

    public function products() 
    {
        return $this->hasMany(Product::class);
    }

}
