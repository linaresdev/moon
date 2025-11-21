<?php

## LOCALES
$this->loadGrammary( $LANG );

## Middleware
$this->loadMiddleware(new \Moon\Http\Middleware\Handler());

## Console
$this->loadCommands(\Moon\Console\Handler::class);


## Routes
$this->loadRoutesFrom(__path('{http}/Routes/app.php'));

## Services
$this->loadAppAuthProvider([
    "auth.providers.users.model" => \Moon\Model\User::class
]);

## Plantillas del aplicativo
//$this->loadThemeFrom(\Moon\Firemoon\Driver::class);
//$skin = Skin::make("firemoon");

## VIEWS
$this->loadViewsFrom(__DIR__.'/Views', 'moon');

## Publish Moon
$this->publishes([
], 'moon');

