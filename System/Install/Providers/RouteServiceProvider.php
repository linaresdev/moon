<?php
namespace Moon\Install\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider {

    protected $namespace = '\\Moon\\Install\\Http\\Controllers';
    public function boot() {
        parent::boot();
    }

    public function map() {
        Route::prefix('install')->namespace($this->namespace)
            ->group(__DIR__."/../Http/routes.php");
    }

}