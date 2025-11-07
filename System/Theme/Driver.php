<?php
namespace Moon\Theme;

class Driver {

    public function info() {
        return [
            'name'          => 'Theme',
            'author'        => 'Ramon A Linares Febles',
            'email'         => 'rlinareslf@gmail.com',
            'license'       => 'Privada',
            'support'       => 'https://support.lc',
            'version'       => 'V-0.0',
            'description'   => 'Soporte de plantillas'
        ];
    }

    public function app()
    {
        return [
            'type' => 'library',
            'slug' => 'theme',
            'driver' => \Moon\Theme\Driver::class,
            'token' => NULL,
            'activated' => 1
        ];
    }
    public function providers() { return []; }
    public function alias() { return []; }

    public function install($app) { }
    public function destroy($app) { }

}