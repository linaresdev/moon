<?php
namespace Moon\Admin\Supports;

class Style {
    protected $taggs = [];

    public function add($key, $value) {
        if( !array_key_exists($key, $this->taggs) ) {
            $this->taggs[$key] = $value;
        }
    }
 
    public function update($key, $value) {
        if( array_key_exists($key, $this->taggs) ) {
            $this->taggs[$key] = $value;
        }
    }

    public function get( $key=null, $default=null )
    {
        if( array_key_exists($key, $this->taggs) ) {
            return $this->taggs[$key];
        }

        return $default;
    }
}