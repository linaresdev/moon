<?php
namespace Moon\Core\Facade;

use Illuminate\Support\Facades\Facade;

class Moon extends Facade {
    public static function getFacadeAccessor(){return 'Moon';}
}