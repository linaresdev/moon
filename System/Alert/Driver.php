<?php
namespace Moon\Alert;

class Driver
{
    public function info()
    {
        return [
            'name'          => 'Alert',
            'author'        => 'Ramon A Linares Febles',
            'email'         => 'rlinareslf@gmail.com',
            'license'       => 'Mit',
            'support'       => 'https://support.lc',
            'version'       => 'V-0.0',
            'description'   => 'Alertas y notificaciones'
        ];
    }

    public function app()
    {
        return [
            'type' => 'package',
            'slug' => 'alert',
            'driver' => '\Moon\Alert\Driver::class',
            'token' => NULL,
            'activated' => 1
        ];
    }

    public function providers() { 
        return [
            \Moon\Alert\Providers\AlertServiceProvider::class
        ]; 
    }
    public function alias() { 
        return [
            "Alert" => \Moon\Alert\Facade\Alert::class,
        ]; 
    }

    public function install($app) { }
    public function destroy($app) { }
}