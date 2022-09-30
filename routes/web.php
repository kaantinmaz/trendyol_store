<?php

//namespace efast\TrendyolStoreApi;

//use efast\trendyol_store_api\Hello;
use Illuminate\Support\Facades\Route;


Route::get('/trendyol/store', function () {
//    return 'trendyol store'. __DIR__;
    return view('trendyol-store::test');
});

Route::get('test', function(Efast\TrendyolStoreApi\Inspire $test) {
    return $test->justDoIt();
});
