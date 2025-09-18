<?php

## URL
if(!function_exists("__url"))
{
    function __url($path, $args=null, $secure=false)
    {
        return Moon::url($path, $args, $secure);
    }
}

#PATH
if(!function_exists("__path"))
{
    function __path( $path ) {
        return Moon::path( $path );
    }
}