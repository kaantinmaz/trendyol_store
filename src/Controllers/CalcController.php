<?php

namespace efast\TrendyolStoreApi;

use App\Http\Controllers;

use Illuminate\Http\Request;

class CalcController extends Controllers\Controller
{
    public function add($a, $b){
        echo $a + $b;
    }

    public function subtract($a, $b){
        echo $a - $b;
    }
}
