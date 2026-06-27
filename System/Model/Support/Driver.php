<?php
namespace Moon\Model\Support;

class Driver 
{   

    public function __construct($file) 
    {
        $data = [];

        if( class_exists($file) ) {            
            $data = array_merge( ($file = new $file)->info(), $file->app());            
        }

        foreach( $this->fillable() as $key ) 
        {
            if( array_key_exists($key, $data) ) {
                $this->{$key} = $data[$key];
            }
            else {
                $this->{$key} = null;
            }
        }
    }

    protected function fillable()
    { 
        return [ 
            "name",
            "author",
            "license",
            "support",
            "version",
            "description",
            "type",
            "slug",
            "driver",
            "token",
            "activated",      
        ];
    }
}