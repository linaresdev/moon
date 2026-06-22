<?php
namespace Moon\Core\Support;

class Temp {
    protected static $app;

    protected $path;

    protected $file;

    protected $data;

    public function __construct( $app ) {
		self::$app   = $app;
	}

    public function driver($drivers, $path="{tmp}/partial")  
    {
        $this->path = __path($path);
        $this->file = "drivers.json";
        
        if( is_array( $drivers ) ) {
            return $this->add(json_encode( $drivers ));
        } 

        return $this;
    }

    public function file( $path, $file ) {
        $this->path = $path; $this->file = $file; return $this;
    }

    public function add( $data )
    {
        if( !app("files")->exists($this->path) ) {
            
            app("files")->makeDirectory( 
                $this->path,  $mode = 0777, $recursive = true
            );
        }

       return app("files")->put( $this->path.'/'.$this->file, $data );       
    }

    public function get( $file )
    {
        if( app("files")->exists($file) )
        {
            $data = app("files")->get($file);
            $data = json_decode($data);
            return $data;
        }
    }

    public function delete( $file ) {
    }
}