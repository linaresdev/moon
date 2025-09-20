<?php

Route::controller(InstallController::class)->group(function(){
    Route::get("/", "index");
    Route::get("/confirm", "confirm");

    Route::get("/env", "env");
    Route::post("/env", "envUpdate");

    Route::prefix("database")->group(function(){
        Route::get("/", "database");

        Route::prefix("migrate")->group(function($route){
            Route::get("/", "migrate");
            Route::get("/refresh", "migrateRefresh");
            Route::get("/reset", "migrateReset");
        });

    });

    Route::get("account", "account");
    Route::post("account", "accountCreate");
});
