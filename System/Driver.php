<?php
namespace Moon;

class Driver
{
    public function info() {

        return [
            'name'          => 'Moon',
            'author'        => 'Ramon A Linares Febles',
            'email'         => 'rlinareslf@gmail.com',
            'license'       => 'Privada',
            'support'       => 'https://support.lc',
            'version'       => 'V-0.0',
            'description'   => 'Gestor de paquetes y contenidos'
        ];
    }

    public function app()
    {
        return [
            'type'      => 'packages',
            'slug'      => 'moon',
            'driver'    => \Moon\Driver::class,
            'token'     => NULL,
            'activated' => 1
        ];
    }

    public function drivers() { 
        return [
        ]; 
    }

    public function providers() { 
        return [
            \Moon\Providers\MoonServiceProvider::class
        ]; 
    }
    public function alias() { 
        return [
        ]; 
    }

    public function install($app) { }
    public function destroy($app) { }
}