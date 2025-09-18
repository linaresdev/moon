<?php
namespace Moon\Install\Http\Controllers;

use App\Controllers\Controller as BaseController;

abstract class Controller
{

    protected $path = "install::";

    public function boot( $app=null, $data=[] )
    {
        $this->app   = $app;     
       
        if( method_exists( $app, 'share' ) ) {
            $data = array_merge( $data, $app->share() );
        }
        
        $this->share( $data );        
    }

    public function share( $data )
    {        
        if( !empty( $data ) && is_array( $data ) ) {
            view()->share( $data );
        }
    }

    public function render( $view=NULL, $data=[], $mergeData=[]) 
    {
        if(view()->exists(($path = $this->path.$view))) {
            return view($path, $data, $mergeData);
        }
        return "La vista $path no existe";
    }
}