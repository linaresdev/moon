<?php
namespace Moon\Firemoon;

class Driver {

    public function info() {

        return [
            'name'          => 'Firemoon',
            'author'        => 'Ramon A Linares Febles',
            'email'         => 'rlinareslf@gmail.com',
            'license'       => 'Mit',
            'support'       => 'https://support.lc',
            'version'       => 'V-0.0',
            'description'   => 'Plantilla por defecto de moon'
        ];
    }

    public function app()
    {
        return [
            'type'      => 'theme',
            'slug'      => 'firemoon',
            'driver'    => \Moon\Firemoon\Driver::class,
            "kernel"    => __DIR__."/Http/App.php",
            'token'     => NULL,
            'activated' => 1
        ];
    }

    public function providers() {}

    public function install($app) { }
    public function uninstall($app) { }
}