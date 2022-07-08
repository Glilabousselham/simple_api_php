<?php

use App\Http\Route;

class App{

    public static function run(){
        $data =  Route::resolve();

        echo json_encode($data);
    }

}