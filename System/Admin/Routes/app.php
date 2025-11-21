<?php

Route::controller(AccountController::class)->group(function()
    {    
        Route::get('/login', "login");
        Route::post('/login', "postLogin");

        Route::get('/logout', "logout");

        Route::get('/getmembership', "getmembership");
        Route::post('/getmembership', "postGetmembership");
    });

Route::prefix(env("MOON_ADMIN_SLUG", "admin"))->group(function(){

    Route::controller(HomeController::class)->group(function(){
        Route::get('/', "index");
    });

});