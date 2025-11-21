<?php
namespace Moon\Admin\Providers;

use Moon\Skin\Facade\Skin;
use Moon\Core\Facade\Moon;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Blade;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Translation\Translator;

use Moon\Providers\ProviderAccessor;

class AdminServiceProvider extends ProviderAccessor {

    public function boot( Kernel $HTTP, Translator $LANG ) {

        $this->http = $HTTP;

        $this->lang = $LANG;

        require_once(__DIR__."/../Supports/Functions.php");
        require_once(__DIR__."/../App.php");
    }

    public function register() {
        $this->mergeConfigFrom(
            __path('{system}/Config/app.php'), "app"
        );
        $this->mergeConfigFrom(
            __path('{system}/Config/guard.php'), "guard"
        );
    }
}