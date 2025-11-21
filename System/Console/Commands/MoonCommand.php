<?php
namespace Moon\Console\Commands;

use Moon\Model\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http; 
use Illuminate\Support\Facades\Schema;

class MoonCommand extends Command {

    protected $signature    = 'moon {opt?}';

    protected $description  = 'Moon Application';

    public function handle()
    {
        $opt = $this->argument( 'opt' );

        if( method_exists( $this, $opt ) ) {
            return $this->{$opt}();
        }

        $this->line("Orden $opt no encontrada");
    }

    protected function stop()
    {
        $appStors = app("files")->get(__path('{tmp}/app.json'));
        $appStors = collect(json_decode($appStors));

        $appStors->each(function($item, $key) {
            if( $key == "app" ) {
                $item->activated = 0;
            }
        });

        app("files")->put(__path('{tmp}/app.json'), $appStors->toJSON());
    }
}