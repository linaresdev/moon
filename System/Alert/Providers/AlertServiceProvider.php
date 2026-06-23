<?php
namespace Moon\Alert\Providers;

use Moon\Alert\Facade\Alert;
use Illuminate\Support\ServiceProvider;

class AlertServiceProvider extends ServiceProvider
{
    public function boot() {
        $this->app->bind("Alert", function($app) {
            return new \Moon\Alert\Support\Alert($this->app);
        });
    }
    // public function register() 
    // {
    //     $this->app->bind("Alert", function($app) {
    //         return new \Moon\Alert\Support\Alert();
    //     });
    // }
}