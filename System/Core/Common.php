<?php
use Moon\Core\Facade\Core;

$this->app->bind("Core", function($app) {
    return new \Moon\Core\Support\Core(
        new \Moon\Core\Support\Loader($app)
    );
});

$app = $this->app;

## BIBLIOTECAS BÁSICAS
Core::load( "url", new \Moon\Core\Support\Url($app) );
Core::load( "finder", new \Moon\Core\Support\Finder($app) );
Core::load( "temp", new \Moon\Core\Support\Temp($app) );
Core::load( "kernel", new \Moon\Core\Support\Kernel($app) );
Core::load( "driver", new \Moon\Core\Support\Driver($app) );

$this->app["core"]  = Core::load();

## COMMON HELPER
require_once(__DIR__."/Support/Helper.php");

## URLS
Core::url([
    "{base}" => Core::dir()
]);

## PATHS
$migrations = str_replace(
    base_path('/'), '/', __SYSTEM__."/Install/Database/Migrations"
);

Core::path([
    "{system}"      => __SYSTEM__,
    "{base}"        => realpath(__DIR__."/../../"),
    "{migrations}"  => $migrations,
    "{tmp}"         => env("APP_TMP", base_path("tmps")),
    "{public}"      => public_path(Core::dir()),
    "{cdn}"         => "{public}/cdn"
]);

// Start Core Applications
//Core::start();
