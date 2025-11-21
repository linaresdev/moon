<?php
namespace Moon\Admin\Supports;

use Moon\Admin\Supports\Style;

class Skin {

    protected $slug;

    public $style;

    public function __construct($slug=null) {
        $this->slug = $slug;
        $this->style = (new Style);
        
    }

    public function css( $key=null, $default=null ) {
        return $this->style->get( $key, $default );
    }

    public function path($path='master') {
        return "$this->slug.$path";
    }

    public function render($view="master", $data=[], $mergeData=[]) {

        if( view()->exists( ($path = $this->path($view)) ) ) {
            return view($path, $data, $mergeData);
        }

        return "ERROR 404 :: La vista {$path} no existe.";
    }
}