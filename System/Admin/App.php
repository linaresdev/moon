<?php

$this->app->setLocale(config("moon.locale", "es"));

$locale = config("moon.faker_locale", "esDO");
$locale = "\Moon\Admin\Locales\\$locale";

if( class_exists( $locale ) ) 
{
    $locale = (new $locale);

    moon( "locale", $locale);

    $header  = $locale->header();
    $lines   = $locale->lines();
    
    $LANG->addLines( $lines, $header["slug"] );    
}

## URLS
//Moon::url([]);


## Middleware
$this->loadMiddleware(new \Moon\Admin\Middleware\Handler());

## CONSOLE
$this->loadCommands(\Moon\Admin\Console\Handler::class);

## VIEWS
$this->loadViewsFrom(__DIR__.'/Views', 'admin');

$this->app["skin"] = new Moon\Admin\Supports\Skin("admin::layout");

## STYLE
$this->app["skin"]->style->add("body", "container");

$data["skin"] = $this->app["skin"];

$this->app["view"]->share($data);

## PUBLISHED
$this->publishes([
    __DIR__."/Storange/Assets" => __path('{public}/admin/assets')
], 'admin');