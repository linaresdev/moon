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

## SEGMENT
if( !function_exists("__segment") ) {
    function __segment( $index=null, $match=null )
    {
        if(is_null($index) ) return request()->segments();

        if( is_numeric($index) ) {
            $segment = request()->segment($index);

            if( !is_null($match) ) {
                return ($segment == $match);
            }

            return $segment;
        }
    }
}

## SECURITY
if( !function_exists("get_user_guard") )
{
    function get_user_guard() 
    {
        $agent = request()->userAgent();
        $guard = (new \Moon\Core\Support\Guard);

        return [
            "ip_address"    => request()->ip(),
            "agent"         => $agent,
            "path"          => request()->path(),
            "device"        => $guard->device($agent),
            "platform"      => $guard->getPlatform($agent),
            "browser"       => $guard->getBrowser($agent),
            "robot"         => $guard->getRobot($agent),
        ];
    }
}