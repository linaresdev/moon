<?php
namespace Moon\Core\Support;

class Core {
    
    protected static $app;

    public function __construct( Loader $app ) 
    {
		self::$app = $app;       

        ## BIBLIOTECAS BÁSICAS
        $this->url = $this->load( "url", new \Moon\Core\Support\Url($app) );
        $this->finder = $this->load( "finder", new \Moon\Core\Support\Finder($app) );
        $this->tmp = $this->load( "temp", new \Moon\Core\Support\Temp($app) );
        $this->kernel = $this->load( "kernel", new \Moon\Core\Support\Kernel($app) );
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
        return $this->url->dir( $path );
    }

    /* URL
     * Soporte para url etiquetadas */
    public function url($key=null) {
        return $this->url->url($key);
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
        if( $this->kernel->start() ) {
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
        return $this->kernel->getApplication();
    }

    public function kernel($driver) {
        $this->kernel->run($driver);
    }
}