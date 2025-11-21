<?php
namespace Moon\Model;

class UserMeta {

    public function __construct( $value ) {
        
        if( !empty($value) ) 
        {
            if( is_string($value) ) {
                $value = (array) json_decode($value);
            }
           
            if( is_array($value) ) {
                foreach( $value as $key => $data ) {
                    $this->{$key} = $data;
                }
            }       
        }
    }

    public function data() {

        if( !empty( ($data = (array) $this) ) ) {
            return $data;
        }
        return [];
    }

    public function save() {
        return json_encode((array) $this);
    }
}