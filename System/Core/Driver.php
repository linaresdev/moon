<?php
namespace Moon\Core;

class Driver {

    public function info() {

        return [
            'name'          => 'Core',
            'author'        => 'Ramon A Linares Febles',
            'email'         => 'rlinareslf@gmail.com',
            'license'       => 'Privada',
            'support'       => 'https://support.lc',
            'version'       => 'V-0.0',
            'description'   => 'Core System'
        ];
    }

    public function app() {

        return [
            'type'      => 'core',
            'slug'      => 'moon',
            'driver'    => \Moon\Core\Driver::class,
            'token'     => NULL,
            'activated' => 1
        ];
    }

    public function drivers() { 
        return [
        ]; 
    }

    public function providers() { return []; }
    public function alias() { return []; }

    public function install($app) { }
    public function destroy($app) { }
}