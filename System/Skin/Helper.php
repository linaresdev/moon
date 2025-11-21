<?php

if( !function_exists("skin") ) 
{
    function skin($view="master") {
        return Skin::path($view);
    }
}

if( !function_exists("style") ) 
{
    function style($key=null) {
    }
}