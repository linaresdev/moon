<?php
namespace Moon\Support;

class Skin {

    protected $slug;
  
    protected $driver;

    public function __construct( $driver ) 
    {
        $this->driver = $driver;

        $skin       = $driver->app();
        $this->slug = $skin['slug']; 
        
    }

    public function path($path='master') {
        return "$this->slug::$path";
    }

    public function render($view="master", $data=[], $mergeData=[]) {

        if( view()->exists( ($path = $this->path($view)) ) ) {
            return view($path, $data, $mergeData);
        }

        return "ERROR 404 :: La vista {$path} no existe.";
    }

    public function style( $slug=null, $args=null ) 
    {
        if( method_exists($this->driver, "style") )
        {
            if( !empty($slug) && is_object(($style = $this->driver->style())) ) {
                return $style->app($slug, $args);
            }
        }
    }
}