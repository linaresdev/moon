<?php
namespace Moon\Core\Providers;

/*
*---------------------------------------------------------
* © Moon Core
* Santo Domingo República Dominicana.
*---------------------------------------------------------
*/

use Moon\Core\Facade\Moon;
use Illuminate\Support\ServiceProvider;

class CoreServiceProvider extends ServiceProvider {

    public function boot() {
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

    }
}