<?php
namespace Moon\Http\Support;

class SkinSupport 
{
    protected $slug;

    public function __construct($driver) 
    {
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
}