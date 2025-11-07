<?php
namespace Moon\Http;

class Driver {

    public function info() {
        return [
            'name'          => 'Moon',
            'author'        => 'Ramon A Linares Febles',
            'email'         => 'rlinareslf@gmail.com',
            'license'       => 'Privada',
            'support'       => 'https://support.lc',
            'version'       => 'V-0.0',
            'description'   => 'Interfaz de usuarios para Moon'
        ];
    }

    public function app()
    {
        return [
            'type' => 'package',
            'slug' => 'bluemoon',
            'driver' => '\Moon\Driver::class',
            'token' => NULL,
            'activated' => 1
        ];
    }

    public function drivers() { 
        return [
            \Moon\Theme\Driver::class,
        ]; 
    }

    public function providers() { 
        return [
            \Moon\Http\Providers\AppServiceProvider::class,
            \Moon\Http\Providers\RouteServiceProvider::class
        ]; 
    }
    public function alias() { 
        return [
            "Skin" => \Moon\Http\Facade\Skin::class,
        ]; 
    }

    public function install($app) { }
    public function destroy($app) { }
}