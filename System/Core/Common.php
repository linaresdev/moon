<?php
use Moon\Core\Facade\Core;

$this->app->bind("Core", function($app) {
    return new \Moon\Core\Support\Core(
        new \Moon\Core\Support\Loader($app)
    );
});

$this->app["core"]  = Core::load();

## BIBLIOTECAS BÁSICAS
Core::load( "url", new \Moon\Core\Support\Url($this->app) );
Core::load( "finder", new \Moon\Core\Support\Finder($this->app) );
//Core::load( "driver", new \Moon\Core\Support\Driver($this->app) );
Core::load( "temp", new \Moon\Core\Support\Temp($this->app) );
Core::load( "kernel", new \Moon\Core\Support\Kernel($this->app) );

## COMMON HELPER
require_once(__DIR__."/Support/Helper.php");