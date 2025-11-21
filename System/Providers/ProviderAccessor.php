<?php
namespace Moon\Providers;


use Illuminate\Support\ServiceProvider;

class ProviderAccessor extends ServiceProvider
{
    public function loadAppAuthProvider($data=[])
    {
        foreach($data as $key => $arg ) {
            $this->app["config"]->set( $key, $arg );
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

    public function getGrammars($locale=null)
    {         
        if( class_exists( ($store = "\Moon\Locales\\$locale") ) ) {
            return (new $store);
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

    public function loadPolicies($handler) {     
        foreach( $handler->policies() as $slug => $policy ) {
            Gate::define($slug, $policy);
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

    public function loadThemeFrom( $THEME ) 
    {
        if( class_exists($THEME) ) 
        {
            $theme  = new $THEME;

            if( method_exists($theme, "support" ) ) 
            {
                $skin = \Moon\Skin\Facade\Skin::boot($theme);

               // $this->app["skin"]  = new \Moon\Support\Skin( $theme );

                ## Helper para plantillas
                //require_once(__path('{http}/Support/Helper.php'));

                ## Plantilla    
                // if( app("files")->exists($theme->support()) ) {
                //     require_once($theme->support());
                // }
            }
        }
    }
}