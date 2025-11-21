<?php
namespace Moon\Providers;

use Moon\Core\Facade\Moon;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Blade;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Translation\Translator;
use Illuminate\Support\ServiceProvider;

class MoonServiceProvider extends ProviderAccessor
{
    public function boot( Kernel $HTTP, Translator $LANG )
    {

        $this->http = $HTTP;

        $this->lang = $LANG;
       
        require_once(__path('{system}/Support/App.php'));
    }

    public function register() { 
        dd("A");
        //require_once(__path('{system}/Support/Helper.php'));       
    }   
    
}