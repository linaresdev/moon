<?php


Route::middleware(["web", "moon"])->group(function()
{
    Route::controller(HomeController::class)->group(function(){
        Route::get('/', "index");
    });

    Route::controller(AccountController::class)->group(function()
    {    
        Route::get('/login', "login");
        Route::post('/login', "postLogin");

        Route::get('/logout', "logout");
    });

    ## Manager App
    Route::prefix(env("APP_URL_ADMIN", "admin"))
        ->namespace("Admin")->group(__path("{http}/Routes/admin.php"));
});
