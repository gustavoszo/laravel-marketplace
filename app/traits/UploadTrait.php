<?php

namespace App\Traits;
use Illuminate\Http\Request;

trait UploadTrait {

    private function imageUpload($images, $imageColumn=null) {

        $imagesUploaded = [];

        if (is_array($images)) {

            foreach($images as $image) {
                $imagesUploaded[] = [$imageColumn=> $image->store('products', 'public')];
            } 

        } else {
            $imagesUploaded = $images->store('logo', 'public');
        }

        return $imagesUploaded;

    }


}