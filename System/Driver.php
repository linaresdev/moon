<?php
namespace Moon;

class Driver
{
    public function info() {

        return [
            'name' => 'Name',
            'author' => 'AuthorName',
            'email' => 'name@server.lc',
            'license' => 'Mit'
            'support' => 'https://support.lc',
            'version' => 'V-0.0',
            'description' => 'Description'
        ];
    }

    public function app()
    {
        return [
            'type' => 'package',
            'slug' => 'cms',
            'driver' => '\Project\Driver::class',
            'token' => NULL,
            'activated' => 1
        ];
    }

    public function providers() { return []; }
    public function alias() { return []; }

    public function install($app) { }
    public function destroy($app) { }

}