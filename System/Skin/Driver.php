<?php
namespace Moon\Skin;

class Driver {

    public function info()
    {
        return [
            'name'          => 'Skin',
            'author'        => 'Ramon A Linares Febles',
            'email'         => 'rlinareslf@gmail.com',
            'license'       => 'Mit',
            'support'       => 'https://support.lc',
            'version'       => 'V-0.0',
            'description'   => 'Soportes para las plantillas'
        ];
    }

    public function app() {

        return [
            'type'      => 'libraries',
            'slug'      => 'skin',
            'driver'    => \Moon\Skin\Driver::class,
            'token'     => NULL,
            'activated' => 1
        ];
    }

    public function providers() { 
        return [
            \Moon\Skin\Provider::class,
        ]; 
    }
    public function alias() { 
        return [
            "Skin" => \Moon\Skin\Facade\Skin::class,
        ]; 
    }

    public function install($app) { }
    public function destroy($app) { }

}