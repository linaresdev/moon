<?php
namespace Moon\Http\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Blade;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Translation\Translator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider 
{
    public function boot( Kernel $HTTP, Translator $LANG ) {

        $this->http = $HTTP;

        $this->lang = $LANG;

        require_once(__DIR__."/../App.php");
    }

    public function register() {
        $this->mergeConfigFrom(
            __path('{system}/Config/app.php'), "app"
        );
    }

    public function loadGrammary( $LANG )
    {
        $this->app->setLocale(config("moon.locale", "es"));

        $locale = config("moon.faker_locale", "esDO");

        
        
        if( !empty( ($grammaries = $this->getGrammars($locale))  ) ) 
        {
            $header  = $grammaries->header();
            $lines   = $grammaries->lines();
            
            $LANG->addLines( $lines, $header["slug"] );
        }
    }

    public function getGrammars($locale=null)
    {         
        if( class_exists( ($store = "\Moon\Http\Locales\\$locale") ) ) {
            return (new $store);
        }
    }

    public function loadCommands($handler)
    {
        if( class_exists($handler) )
        {
            if( $this->app->runningInConsole() )
            {
                $this->commands((new $handler)->commands());
            }
        }
    }

    public function loadPolicies($handler) {     
        foreach( $handler->policies() as $slug => $policy ) {
            Gate::define($slug, $policy);
        }
    }

    public function loadMiddleware($store)
    {
        ## STARTED
        if( !empty( ($started = $store->start() ) ) ) {
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
    public function loadSkinFrom($driver)
    {
        if( class_exists($driver) ) 
        {
            $driver = new $driver;
            $skin = $driver->app();

            $this->app["skin"] = new \Moon\Http\Support\SkinSupport($driver);

            if( app("files")->exists($skin["kernel"]) ) {
                require_once($skin["kernel"]);
            }
        }
    }
}