<?php


Route::middleware(["web", "moon"])->group(function()
{
    Route::controller(HomeController::class)->group(function(){
        Route::get('/', "index");
    });

    
});
