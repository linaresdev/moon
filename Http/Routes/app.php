<?php

Route::controller(HomeController::class)->group(function(){
    Route::get('/', "index");
});

Route::controller(AuthController::class)->group(function(){
    Route::get('/login', "getLogin");
    Route::post('/login', "postLogin");
});