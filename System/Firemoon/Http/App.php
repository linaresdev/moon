<?php

$data["lang"]       = $this->app->getLocale();
$data["charset"]    = config("app.charset", "utf-8");
$data["title"]      = "FireMoon";
$data["container"]  = "";

$this->app['view']->share($data);

## HELPERS
Moon::url([
    "{cdn}"     => '{base}/cdn',
   "{firemoon}" =>  '{base}/templates/firemoon',

]);

## VIEWS
$this->loadViewsFrom(__DIR__.'/Views', 'firemoon');

## Publish Moon
$this->publishes([
    __DIR__."/Assets" => __path("{public}/templates/firemoon/assets"),
], 'firemoon' );