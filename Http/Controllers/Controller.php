<?php
namespace Moon\Http\Controllers;

use Moon\Model\User;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

abstract class Controller extends BaseController 
{
    use AuthorizesRequests, ValidatesRequests;

    protected $app;

    protected $path = "moon::";

    public function boot($app)
    {           
        $data = [];       

        if( method_exists($app, "share") ) 
        {
            if(is_array($app->share()) ) {
                $data = array_merge($data, $app->share());
            }
        }

        if( method_exists($this, "preBoot") ) {
           $this->preBoot( $app );
        }

        if( method_exists($app, "boot") ) {
            $app->boot();
        }

        $this->app = $app;

        $data["skin"] = app("skin");

        view()->share($data);
    }  

    public function render($view=null, $data=[], $mergeData=[])
    {
        if( view()->exists( ($view = $this->path.$view) ) )
		{
			return view($view, $data, $mergeData);
		}

		return "ERROR 404 :: La vista {$view} no existe.";
    }
}