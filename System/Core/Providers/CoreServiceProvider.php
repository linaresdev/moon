<?php
namespace Moon\Core\Providers;

use Moon\Core\Facade\Moon;
use Moon\Core\Facade\Driver;
use Illuminate\Support\ServiceProvider;

class CoreServiceProvider extends ServiceProvider {

    public function boot() 
    {        
        /*
            *  INIT MAP
            *  Niveles de ejecución del registro
            * -----------------------------------------------------------------
            * [4] => THEMES | [4] => WIDGETS
            * -----------------------------------------------------------------
        */

        foreach(Driver::boot() as $driver ) {
            if( method_exists($driver, "support") ) {
                require_once($driver->support());
            }
        }
    }

    public function register() 
    {
        require_once(__DIR__."/../Common.php");        

        /*
            *  INIT MAP
            *  Niveles de ejecución del registro
            * -----------------------------------------------------------------
            * [0] => CORE | [1] => LIBRARIES | [2] => PACKAGES | [3] => PLUGINS
            * -----------------------------------------------------------------
        */
        
        foreach(Driver::register() as $driver ) {
            if( ($driver->app())["activated"] == 1 ) {
                Moon::kernel($driver);
            }
        }

        
    }
}