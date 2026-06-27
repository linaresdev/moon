<?php
namespace Moon\Core\Support;

class Core {
    
    protected static $app;

    public function __construct( Loader $app ) 
    {
		self::$app = $app;
	}

    /* BOOTSTRAP
     * Coleccionador singleton */
	public function load( $key=NULL, $args=[], $params=[] ) 
    {        
		$arg = self::$app->load( $this, $key, $args, $params );

        if( !empty($args) ) {
            $this->{$key} = $arg;
        }

        return $arg;
	}

    /* GUARD
    * Capa de seguridad */
    public function guard( $method=null, $arg=null ) {

        if( !empty($method) )
        {
            if( method_exists($this->guard, $method) ) {
                return $this->guard->{$method}($arg);
            }
        }
    }

    /* PATH
    * Con soporte para rutas etiquetadas */
    public function path($key=null) {
        return $this->load("url")->path($key);
    }

    /* DIRECTORY
     * Directorio publico del aplicactivo */
    public function dir( $path=null ) {
        return $this->load("url")->dir( $path );
    }

    /* URL
     * Soporte para url etiquetadas */
    public function url($key=null) {
        return $this->load("url")->url($key);
    }

    /* DRIVERS
     * Soporte para drivers */    
    public function driverlinks() {
        return app("db")->table("drivers")->where("state", 1)->get();
    }

    public function driver( $driver ) {        
       return $this->load("driver")->add($driver);
    }    

    /* CORE
     * Core del aplicativo */
    public function core() {
        return $this->kernel->getApplication();
    }

    public function run($driver) {
        $this->kernel->run($driver);
    }
}