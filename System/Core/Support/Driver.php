<?php
namespace Moon\Core\Support;

use Moon\Core\Support\Temp;
use Moon\Core\Support\DriverValidate;

class Driver 
{
    protected static $app;

    protected static $moon;

    protected $core;
    
    protected $containers = [
        "libraries"     => [],
        "packages"      => [],
        "plugins"       => [],
        "themes"        => [],
        "widgets"       => []
    ];
    

    public function __construct() {   
	}

    public function containers() {
        return $this->containers;
    }

    public function add($driver=null)
    {        
        if( !empty(($app = $this->extract($driver)) ) ) 
        {
            if( array_key_exists($app["type"], $this->containers) )
            {
                if( !array_key_exists($app["slug"], $this->containers[$app["type"]])  )
                {
                    $this->containers[$app["type"]][$app["slug"]] = new $app["driver"];
                }
            }            
        }
    }

    public function addFromFile( $path ) 
    {
        if( ($data = $this->stractFromFile($path)) != null )
        {
            foreach( $this->containers as $key => $value ) 
            { 
                if( isset($data->{$key}) ) 
                {
                    if( !empty( ($drivers = $data->{$key})) )
                    {
                        foreach($drivers as $driver ) {
                            $this->add($driver);
                        }
                    }
                }
            }
        }
    }

    public function boot()
    {
        $row = [];

        foreach(["themes", "widgets"] as $key ) 
        {
            foreach($this->containers[$key] as $driver ) {
                $row[] = $driver;
            }
        }

        return $row;
    }

    public function core($driver) 
    {
        if( !empty(($app = $this->extract($driver)) ) ) {
            $this->core = new $driver;
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

    public function stractFromFile($path)
    { 
        if(app("files")->exists($path) )
        {
            if( !empty( ($dataFile = app("files")->get($path)) ) ) 
            {
                return json_decode($dataFile);
            }
        }
    }

    public function register()
    {
        $row = [];

        foreach(["libraries", "packages", "plugins"] as $key ) 
        {
            foreach($this->containers[$key] as $driver ) {
                $row[] = $driver;
            }
        }

        return $row;
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