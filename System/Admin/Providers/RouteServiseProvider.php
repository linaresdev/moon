<?php
namespace Moon\Admin\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiseProvider extends ServiceProvider {

    protected $namespace = "Moon\\Admin\\Controllers";

    public function boot() {
        parent::boot();
    }

    public function map() {
        Route::middleware("web")->namespace($this->namespace)->group(__DIR__."/../Routes/app.php");
    }

}