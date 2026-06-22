<?php
namespace Moon\Core\Providers;

use Moon\Core\Facade\Core;
use Moon\Core\Facade\Driver;
use Illuminate\Support\ServiceProvider;

class CoreServiceProvider extends ServiceProvider {

    public function boot() {}
    
    public function register() 
    {
        define("__MOON__", realpath(__DIR__ . "/../../../"));
        define("__HTTP__", __MOON__."/Http");
        define("__SYSTEM__", __MOON__."/System");
        
        require_once __DIR__ . "/../Common.php";    
        
    }
}