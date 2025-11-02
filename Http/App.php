<?php

## LOCALES
$this->loadGrammary( $LANG );

## Middleware
$this->loadMiddleware(new \Moon\Http\Middleware\Handler());

## Console
//$this->loadCommands(\Moon\Http\Console\Handler::class);


## Routes
//$this->loadRoutesFrom(__HTTP__.'/Routes/app.php');

## TEMPLATE
$this->loadSkinFrom(config("app.skin.driver", \Moon\Firemoon\Driver::class));


## VIEWS
$this->loadViewsFrom(__DIR__.'/Views', 'moon');

## Publish Moon
$this->publishes([
], 'moon');
