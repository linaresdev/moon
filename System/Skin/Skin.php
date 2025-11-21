<?php
namespace Moon\Skin;

class Skin {

    protected $slug;

    public function make($slug=null) {
        $this->slug = $slug; return $this;
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