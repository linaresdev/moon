<?php

Moon::url([
    "{cdn}" => Moon::dir("/cdn")
]);

## DATABASE
$this->loadMigrationsFrom( __path("{system}/Install/Database/Migrations") );

## Routes
$this->loadRoutesFrom(__DIR__."/routes.php");

## Views
$this->loadViewsFrom(__DIR__."/Views", "install");

## Public
$this->app['view']->share([
    "lang"      => app()->getLocale(),
    "charset"   => "utf-8",
    "container" => "container"
]);

$this->publishes([
    __DIR__.'/../Public/tmps' => base_path("tmps"),
    __DIR__.'/../Public/cdn' => __path("{public}/cdn"),

], 'public');