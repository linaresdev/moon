<?php
use Moon\Core\Facade\Core;

$this->app->bind("Core", function($app) {
    return new \Moon\Core\Support\Core(
        new \Moon\Core\Support\Loader($app)
    );
});

$this->app["core"]  = Core::load();

## COMMON HELPER
require_once(__DIR__."/Support/Helper.php");