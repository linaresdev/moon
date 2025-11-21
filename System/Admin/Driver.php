<?php
namespace Moon\Admin;

class Driver {

    public function info() {
        return [
            'name'          => 'Moon',
            'author'        => 'Ramon A Linares Febles',
            'email'         => 'rlinareslf@gmail.com',
            'license'       => 'Privada',
            'support'       => 'https://support.lc',
            'version'       => 'V-0.0',
            'description'   => 'Administrador para Moon'
        ];
    }

    public function app()
    {
        return [
            'type' => 'packages',
            'slug' => 'admin',
            'driver' => \Moon\Admin\Driver::class,
            'token' => NULL,
            'activated' => 1
        ];
    }

    public function drivers() { 
        return [
        ]; 
    }

    public function providers() { 
        return [
            \Moon\Admin\Providers\AdminServiceProvider::class,
            \Moon\Admin\Providers\RouteServiseProvider::class
        ]; 
    }
    public function alias() { 
        return [
        ]; 
    }

    public function install($app) { }
    public function destroy($app) { }
}