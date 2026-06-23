<?php
namespace Moon

class Driver {

    public function info() 
    {
        return [
            'name'  => 'Moon',
            'author' => 'Ramon A Linares',
            'email' => 'rlinareslf@gmail.com',
            'license' => 'Mit'
            'support' => 'https://support.lc',
            'version' => 'V-0.0',
            'description' => 'Gestor de componentes y contenidos'
        ];
    }

    public function app()
    {
        return [
            'type' => 'package',
            'slug' => 'moon',
            'driver' => \Moon\Driver::class,
            'token' => NULL,
            'activated' => 1
        ];
    }

    public function providers() { return []; }
    public function alias() { return []; }

    public function install($app) { }
    public function destroy($app) { }

}