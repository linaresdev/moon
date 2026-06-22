<?php namespace Moon\Core\Support;

use \Illuminate\Contracts\Routing\UrlGenerator;

class Url {

	protected $base_dir;

    protected $secure;

	protected $taggs = [
		"urls" => [],
		"paths" => []
	];

	public function __construct( $urls ) 
    {
        $this->base_dir = env("APP_DIR", "moon");
        $this->secure   = env("APP_SECURE", false);
	}

	public function dir($path=null) {
		return trim($this->base_dir."/".trim($path, '/'), "/");
	}

	public function replaceRul($tagg, $key, $value) {
		foreach( $this->taggs[$tagg] as $alia => $path ) {
			$value =  str_replace( $alia, $path, $value );
		}
		return $value;
	}

	public function addTag( $tagg=NULL, $segments=[] ) {
		foreach ($segments as $key => $value) {
			$this->taggs[$tagg][$key] = $this->replaceRul($tagg, $key, $value);
		}
	}

	function url( $path = null, $parameters = [], $secure = null)
	{	
		if( !empty($path) )
		{
			if( is_string($path) ) 
			{
				if(is_null($secure)) {
					$secure = $this->secure;
				}

				if(!empty(($urls = $this->taggs["urls"]))) 
				{
					foreach ($urls as $key => $value) {
						$path = str_replace($key, $value, $path);
					}
				}

				return app(UrlGenerator::class)->to($path, $parameters, $secure);
			}

			if( is_array($path) ) {
				return $this->addTag("urls", $path);
			}
		}

		return app(UrlGenerator::class);
    }

    public function path($path=null) {

		if( !empty($path) )
		{
			if( is_string( $path ) )
			{
				if(!empty(($paths = $this->taggs["paths"]))) {
					foreach( $paths as $key => $value ) {
						$path = str_replace($key, rtrim($value, '/'), $path);
					}
				}
			}

			if( is_array($path) ) {
				return $this->addTag("paths", $path);
			}

			return $path;
		}

		return app()->basePath($path);      
    }

    public function publicPath($path=null) {
        return public_path($this->dir()."/".trim($path, "/"));
    }

    public function themePath($skin=null) {
        return $this->publicPath("themes/".$skin );
    }
}