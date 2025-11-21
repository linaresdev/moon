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
            'type'      => 'themes',
            'slug'      => 'firemoon',
            'driver'    => \Moon\Firemoon\Driver::class,
            'token'     => NULL,
            'activated' => 1
        ];
    }

    public function support() {
        return __DIR__."/Http/App.php";
    } 

    public function style() {
        return new \Moon\Firemoon\Http\Style();
    }

    public function providers() {}

    public function install($app) { }
    public function uninstall($app) { }
}