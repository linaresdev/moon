<?php


Route::middleware("web")->group(function()
{
    Route::controller(HomeController::class)->group(function(){
        Route::get('/', "index");
    });

    Route::controller(AccountController::class)->group(function()
    {    
        Route::get('/login', "login");
        Route::post('/login', "postLogin");
    });
});