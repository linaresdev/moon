<?php
namespace Moon\Core\Providers;

use Moon\Core\Facade\Moon;
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

        /*
        * [4] THEMES */
        $this->load("themes");

        /*
        * [5] WIDGETS */  
        $this->load("widgets");
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
        
        /*
        * [1]  LIBRARIES */
        $this->load("libraries");

        /*
        * [2] PACKAGES */
        $this->load("packages");

        /*
        * [3] PLUGINS */      
        $this->load("plugins");
    }

    public function load( $slug ) 
    { 
        if( isset($this->core->{$slug}) )
        {
            foreach( $this->core->{$slug} as $row ) {
                $this->app["moon"]->kernel($row);
            }
        }
    }

}