<?php
namespace Moon\Core\Support;

use Moon\Core\Support\Temp;
use Moon\Core\Support\DriverValidate;

class Driver 
{
    public $library  = [];
    
    public $package  = [];

    public $plugin   = [];

    public $theme    = [];

    public $widget   = [];    

    public function __construct() {
	}

    public function applications() {
        return ((array) $this);
    }

    public function add($driver=null)
    {
        if( !empty(($app = $this->extract($driver)) ) ) 
        {
            if( array_key_exists($app["type"], ($store = ((array) $this))) )
            {
                if( !array_key_exists($app["slug"], $this->{$app["type"]}) ) {
                    $this->{$app["type"]}[$app["slug"]] = new $app["driver"];
                }
            }            
        }
    }

    public function extract($driver) 
    {
        if( is_string($driver) ) 
        {
            if( class_exists($driver) ) {
                $driver = new $driver;
            }
        }
       
        if( is_object($driver) ) {
            if( $this->validate($driver->app()) ) {
                return $driver->app();
            }
        }
    }

    public function validate($app)
    {
        $fillable = [
            "type" , "slug", "driver", "activated"
        ];
        
        foreach( $fillable as $field )
        {
            if( !array_key_exists($field, $app) ) {
                return false;
            }
        }

        if( is_string( $app["driver"] ) && !class_exists($app["driver"]) ) {
            return false;
        }

        return true;
    }    
}