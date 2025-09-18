<?php
namespace Moon\Core\Support;

use Moon\Core\Support\Temp;

class Driver 
{
    protected static $app;

    protected static $moon;

    protected $drivers = [
        "package"   => [], 
        "plugin"    => [], 
        "widget"    => [], 
        "theme"     => []
    ];

    public function __construct( $app ) {
		self::$app  = $app;  
        self::$moon = $app["moon"];    
	}

    public function load($driver) 
    {
        if( $this->validate( $driver ) ) {   
            //(new Temp())->add(__path("{tmp_driver}"), $this->driver->app());                
        }

        return $this;
    }

    public function validate( $driver )
    {
        try {
            if( class_exists($driver) ) 
            {
                $driver = new $driver;
                $app    = $driver->app();
    
                $ruls["type"]        = "required|min:22";
                $ruls["slug"]        = "required";
                $ruls["driver"]      = "required";
                $ruls["activated"]   = "required";
    
                $errors = null;
    
                foreach($driver->app() as $key => $value )
                {
                    if( array_key_exists($key, $ruls) ) {
                        if( preg_match('/required/', $ruls[$key]) ) {
                            if( empty($value) ) {
                                $errors[$key]["required"] = "Campo $key es requerido";
                            }
                        }
                    }
                }
    
                if( is_null($errors) ) {               
    
                    if( array_key_exists(($type = $app["type"]), $this->drivers) ) {                    
                        $this->drivers[$type][$app["slug"]] = $app["driver"];
                    }
    
                    return true;
                }
            }
    
            return false;
        } catch (\Throwable $th) {
           throw new \Moon\Core\Exceptions\ValidDriverException($th->getMessage());
        }
    }

    public function mount() 
    {
        if( !app("files")->exists( __path("{tmp}/drivers.json") ) ) {
            return self::$moon->load("temp")->driver($this->drivers);
        }
        else {
            $drivers = self::$moon->load("temp")->get(__path("{tmp}/drivers.json"));
        }
    }
}