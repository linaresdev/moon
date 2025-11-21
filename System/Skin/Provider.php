<?php
namespace Moon\Skin;

use Moon\Skin\Facade\Skin;
use Illuminate\Support\ServiceProvider;

class Provider extends ServiceProvider {

    public function boot() {
        require_once(__DIR__."/Helper.php");
    }

    public function register()
    {
        $this->app->bind("Skin", function($app){
            return new \Moon\Skin\Skin($app);
        });
    }
}