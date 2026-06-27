<?php
namespace Moon\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider 
{

    protected $namespace = "\\Moon\\Http\\Controllers";

    public function boot() {
        parent::boot();
    }

    public function map() {
        Route::namespace($this->namespace)->group(__path('{http}/Route/app.php'));
    }

}