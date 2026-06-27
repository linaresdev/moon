<?php
namespace Moon\Night;

class Driver {

    public function info() {

        return [
            'name'          => 'Night',
            'author'        => 'Ramon A Linares Febles',
            'email'         => 'rlinareslf@gmail.com',
            'license'       => 'Mit',
            'support'       => 'https://support.lc',
            'version'       => 'V-0.0',
            'description'   => 'Plantialla por defecto'
        ];
    }

    public function app() {

        return [
            'type' => 'themes',
            'slug' => 'night',
            'driver' => __DIR__."/App.php",
            'token' => NULL,
            'activated' => 1
        ];
    }

    public function drivers() {
        return [];
    }

    public function providers() { return []; }
    public function alias() { return []; }

    public function install($app) { }
    public function destroy($app) { }

}