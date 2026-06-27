<?php

$this->app["config"]->set("app.skin", "night");

## Locales
$this->loadGrammary( $LANG );

## Console
$this->loadCommands(\Moon\Console\Handler::class);

## Middleware
# add
$this->loadMiddleware(new \Moon\Http\Middleware\Handler());
$this->app['router']->pushMiddlewareToGroup("web", \Moon\Http\Middleware\AuthMiddleware::class);
//dd($this->app["router"]);

## VIEWS
$this->loadViewsFrom(__DIR__.'/Views', 'moon');


## Publish Moon
$this->publishes([
], 'moon');