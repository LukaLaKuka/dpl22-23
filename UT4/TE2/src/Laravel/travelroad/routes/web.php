<?php

use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    return view('travelroad',[]);
});

Route::get('/wished', function () {
    $wished = DB::select('select * from places where visited = false');
    return view('wished',['wished' => $wished]);
});

Route::get('/visited', function () {
    $visited = DB::select('select * from places where visited = true');
    return view('visited',['visited' => $visited]);
});