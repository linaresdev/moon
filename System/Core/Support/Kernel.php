<?php
namespace Moon\Core\Support;

use Illuminate\Foundation\AliasLoader;

class Kernel
{
    protected static $app;

    protected $application;

    public function __construct( $app ) {
		self::$app   = $app;
	}

    /*
	* ALIASES
	* Load Alias */
	public function loadAlias($alias=NULL)
    {
		if(!empty($alias) && is_array($alias)) {
			foreach ($alias as $alia => $class) {
				AliasLoader::getInstance()->alias($alia, $class);
			}
		}
	}

	/*
	* PROVIDERS
	* Load ServiceProvider */
	public function loadProviders($providers=[])
    {
		if( !empty($providers) )
        {
            if(!is_array($providers)) $providers = [$providers];

            foreach ($providers as $provider) {
                self::$app->register($provider);
            }
        }
	}

    /*
   * RUN
   * Iniciar modulo de forma manual */
	public function run($driver=NULL) {

        if( !empty($driver) ) {
            if( class_exists($driver) )
            {
                if(is_string($driver)) $driver = new $driver;
                
                if( method_exists($driver, "providers") ) 
                {
                    if( !empty( ($providers = $driver->providers()) ) ) {
                        $this->loadProviders( $providers );
                    }
                }
                
                if( method_exists($driver, "alias") ) {
                    $this->loadAlias( $driver->alias() );
                }
            }
        }
	}

    public function start()
    {
        if( self::$app["files"]->exists("core.json") ) {
            $core = self::$app["files"]->get("core.json");

            return $true;
        }

        return false;
    }
}