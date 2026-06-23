<?php
namespace Moon\Install\Providers;

use Illuminate\Support\ServiceProvider;

class InstallServiceProvider extends ServiceProvider {

    public function boot() {
        require_once(__DIR__."/../Http/App.php");
    }

    public function register() {        
    }
}