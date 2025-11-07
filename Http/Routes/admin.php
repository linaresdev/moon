<?php

Route::controller(HomeController::class)->group(function(){
    Route::get('/', "home");
});