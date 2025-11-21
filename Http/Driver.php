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
            'type' => 'packages',
            'slug' => 'bluemoon',
            'driver' => \Moon\Http\Driver::class,
            'token' => NULL,
            'activated' => 0
        ];
    }

    public function drivers() { 
        return [
        ]; 
    }

    public function providers() { 
        return [
            \Moon\Http\Providers\BlueServiceProvider::class,
            \Moon\Http\Providers\RouteServiceProvider::class
        ]; 
    }
    public function alias() { 
        return [
        ]; 
    }

    public function install($app) { }
    public function destroy($app) { }
}