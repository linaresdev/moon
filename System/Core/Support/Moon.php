<?php
namespace Moon\Core\Support;

use Moon\Core\Support\Loader;

class Moon
{
    protected static $app;

    public function __construct( Loader $app ) {
		self::$app = $app;       
	}

    /* BOOTSTRAP
     * Coleccionador singleton */
	public function load( $key=NULL, $args=[], $params=[] ) {
		return self::$app->load( $this, $key, $args, $params );
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

    /* DRIVER
     * Soporte para drivers */
    public function driver( $class ) {
        
       // return $this->load("driver")->load($class);
    }

    /* Application
     * Soporte de Inicio */
    public function start()
    {        
        if( ($kernel = $this->load("kernel"))->start() ) {
            return true;
        }
        else {
            $kernel->run(\Moon\Install\Driver::class);
        }

        return false;
    }

    /* CORE
     * Core del aplicativo */
    public function core() {
        return $this->load("kernel")->getApplication();
    }

    public function kernel($driver) {
        $this->load("kernel")->run($driver);
    }
}