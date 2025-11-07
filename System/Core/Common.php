<?php

$this->app->bind("Moon", function( $app )
{
    return new \Moon\Core\Support\Moon(
        new \Moon\Core\Support\Loader($app)
    );
});

## LUNA
$this->app["moon"] = Moon::load();

## Helper luna
if( !function_exists( "moon" ) )
{    
    function moon( $key=null, $args=null )
    {
        $app = Moon::load();
        
        if( !empty($key) )
        {
            if( empty($args) ) {
                return Moon::load( $key );
            }

            if( !empty($args) && $args instanceof  \Closure ) {
                Moon::load( $key, $args($app) );
                return Moon::load($key);
            }
    
            if( !empty($args) && is_object($args) ) 
            {
                Moon::load($key, $args);
                return Moon::load($key);
            }
        }

        return $app;
    }
}

## BIBLIOTECAS BÁSICAS
Moon::load( "url", new \Moon\Core\Support\Url($this->app) );
Moon::load( "finder", new \Moon\Core\Support\Finder($this->app) );
Moon::load( "driver", new \Moon\Core\Support\Driver($this->app) );
Moon::load( "temp", new \Moon\Core\Support\Temp($this->app) );
Moon::load( "kernel", new \Moon\Core\Support\Kernel($this->app) );

# URLS && PATHS
Moon::url([
    "{base}" => Moon::dir(),
]);

Moon::path([
    ## Real Path
    "{base}"    => realpath(__DIR__."/../../"),
    "{http}"    => "{base}/Http",
    "{system}"  => "{base}/System",
    "{migrations}" => "{system}/Database/Migrations",
    "{tmp}"     => env("APP_TMP", base_path("tmps")),
    "{public}"  => public_path(Moon::dir()),
    
    ## Small Paths
    "{smpath}"      => str_replace(base_path('/'), null, realpath(__DIR__."/../../")),
    "{smhttp}"      => "{smpath}/Http",
    "{smsystem}"    => "{smpath}/System",
    "{smcore}"      => "{smsystem}/Core",    
]);

## COMMON HELPER
require_once(__DIR__."/Support/Helper.php");

if( Moon::start() ) {
    $this->core = Moon::core();
}