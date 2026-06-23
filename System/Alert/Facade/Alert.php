<?php
namespace Moon\Alert\Facade;

use Illuminate\Support\Facades\Facade;

class Alert extends Facade {
    public static function getFacadeAccessor(){return 'Alert';}
}