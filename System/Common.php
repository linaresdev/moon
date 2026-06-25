<?php


## Services
$this->app['config']->set([
    "auth.providers.users.model" => \Moon\Model\User::class
]);