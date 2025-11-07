<?php

if( !function_exists("skin") )
{
    function skin( $key ) {
        $skin = app("skin");

        if( !empty($key) ) {
            return $skin->path($key);
        }

        return $skin;
    }
}

if( !function_exists("style") )
{
    function style( $key=null, $args=null ) {
        return (new \Moon\Support\Style)->app($key, $args);
    }
}