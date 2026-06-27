<?php
namespace Moon\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Blade;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Translation\Translator;
use Illuminate\Support\ServiceProvider;

class MoonServiceProvider extends ServiceProvider 
{
    

    public function boot( Kernel $HTTP, Translator $LANG ) {
        require_once(__path( '{http}/App.php' ));
    }

    public function register() {
        require_once(__path( '{system}/Common.php' ));
    }

    public function getGrammars($locale=null)
    {         
        if( class_exists( ($store = "\Moon\Locales\\$locale") ) ) {
            return (new $store);
        }
    }

    public function loadGrammary( $LANG )
    {
        $this->app->setLocale(config("moon.locale", "es"));
        $locale = config("moon.faker_locale", "esDO");
        
        if( !empty( ($grammaries = $this->getGrammars($locale))  ) ) 
        {
            moon( "locale", $grammaries);

            $header  = $grammaries->header();
            $lines   = $grammaries->lines();
            
            $LANG->addLines( $lines, $header["slug"] );
        }
    }

    public function loadCommands($handler)
    {
        if( class_exists($handler) )
        {
            if( $this->app->runningInConsole() ) {
                $this->commands((new $handler)->commands());
            }
        }
    }

    public function loadMiddleware($store)
    {
        ## STARTED
        if( !empty( ($started = $store->start() ) ) ) 
        {
            foreach($started as $middleware ) {
                $this->http->pushMiddleware( $middleware );
            }
        }

        ## GROUPS
        if( !empty( ( $groups = $store->groups() ) ) ) {
            foreach( $groups as $name => $group ) {
                $this->app["router"]->middlewareGroup($name, $group);
            }
        }

        ## ROUTES
        if( !empty( ($routes = $store->routes() ) ) ) {
            foreach($routes as $route => $middleware ) {
                $this->app["router"]->middleware( $route, $middleware );
            }
        }
    }
}