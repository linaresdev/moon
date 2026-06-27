<?php
namespace Moon\Core\Providers;

use Moon\Core\Facade\Core;
use Moon\Core\Facade\Driver;
use Illuminate\Support\ServiceProvider;

class CoreServiceProvider extends ServiceProvider {

    public function fillable() {
        return [
            "libraries",
            "packages",
            "plugins",
            "themes",
            "widgeds"
        ];
    }

    public function boot() 
    {
        
    }
    
    public function register() 
    {
        define("__MOON__", realpath(__DIR__ . "/../../../"));
        define("__HTTP__", __MOON__."/Http");
        define("__SYSTEM__", __MOON__."/System");
        
        require_once __DIR__ . "/../Common.php";    
        
    }

    public function bootThemes($themes) 
    {
        foreach( $themes as $theme )
        {
            $app = (object) $theme->app();
            
            if( $app->slug == config("app.skin") ) 
            {
                if( $this->app["files"]->exists( ($file = $app->driver) ) ) {
                    require_once( $file );
                }
            }

        }
    }

    public function bootComponents( $components )
    {
        foreach( $components as $app ) 
        {
            $driver = (object) $app->app();
            
            if( $this->app["files"]->exists(($driver = $driver->driver))) {
                include_once($driver);
            }
        }
    }

    public function registerDrivers($drivers) 
    {
        foreach( $drivers as $driver ) {
            Core::run($driver);
        }
    }
}