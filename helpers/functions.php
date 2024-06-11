<?php

namespace Helpers;

class Functions {

    public static function formatPriceToDatabase($price) {
        
        return str_replace(['.', ','], ['', '.'], $price);
    
    } 

}