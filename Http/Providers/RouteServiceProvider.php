<?php
namespace Moon\Http\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider {

    public function boot() {
        parent::boot();
    }

    public function map() {
       Route::namespace("Moon\\Http\Controllers")->group(__path('{http}/Routes/app.php'));
    }
}