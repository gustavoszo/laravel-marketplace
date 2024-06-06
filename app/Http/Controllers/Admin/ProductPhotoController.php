<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductPhotoController extends Controller
{
    
    public function removePhoto(Request $request) 
    {

        $photoName = $request->get('photoName');

        if(Storage::disk('public')->exists($photoName)) {
            Storage::disk('public')->delete($photoName);
        }

        $removePhoto = ProductPhoto::where('image', $photoName);
        $product_id = $removePhoto->first()->product_id;
        
        $removePhoto->delete();

        return redirect()->route('admin.products.edit', ['product'=> $product_id])->with('success', 'Foto removida com sucesso');

    }

}
