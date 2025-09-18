<?php
namespace Moon\Install;

class Driver
{
    public function info()
    {
        return [
            'name'          => 'Install',
            'author'        => 'Ramon A Linares Febles',
            'email'         => 'rlinareslf@gmail.com',
            'license'       => 'Privada',
            'support'       => 'https://support.lc',
            'version'       => 'V-0.0',
            'description'   => 'Asistentent de instalacion'
        ];
    }

    public function app()
    {
        return [
            'type' => 'package',
            'slug' => 'install',
            'driver' => '\Moon\Install\Driver::class',
            'token' => NULL,
            'activated' => 1
        ];
    }

    public function providers() { 
        return [
            \Moon\Install\Providers\InstallServiceProvider::class,
            \Moon\Install\Providers\RouteServiceProvider::class,
        ]; 
    }
    public function alias() { return []; }

    public function install($app) { }
    public function destroy($app) { }
}