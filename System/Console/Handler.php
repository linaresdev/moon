<?php
namespace Moon\Console;

class Handler {

    public function commands() 
    {
        return [
            \Moon\Console\Commands\MoonCommand::class,
        ];
    }
}