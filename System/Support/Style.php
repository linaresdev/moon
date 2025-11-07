<?php
namespace Moon\Support;

class Style {

    protected $taggs = [];

    public function __construct()
    {
        ## Standar Keys
        $this->add("html", "");
        $this->add("body", "");
        $this->add("header", "");
        $this->add("navbar", "");
        $this->add("nav", "");
        $this->add("aside", "");
        $this->add("footer", "");
    }

    public function app( $slug=null, $args=null ) 
    {
        if( !empty($slug) ) 
        {
            if( $slug instanceof \Closure ) {
                return $slug($this, $args);
            }

            if( empty($args) ) {
                return $this->get($slug);
            }            

            if( ($args instanceof \Closure) && array_key_exists( $slug, $this->taggs ) ) {
                $this->taggs[$key] = $args($this->taggs);
            }
        } 
        
        return $this;
    }

    ## Herencia
    public function add($key=null, $value=null) 
    {
        if( !empty($key) ) 
        {
            if( is_string($value) ) {
                $this->taggs[$key] = $value;
            }

            if( ($value instanceof \Closure) && array_key_exists( $key, $this->taggs ) ) {
                $this->{$key} = $value($this->taggs[$key]);
            }
        }        
    }

    public function get($key=null) 
    {
        if( array_key_exists($key, $this->taggs) ) {
            return $this->taggs[$key];
        }
    }

    public function set($key=null, $value=null) 
    {
        if( array_key_exists($key, $this->taggs) ) {
            return $this->taggs[$key] = $value;
        }
    }

    ## End Herencia

    public function index() {

        $data['title'] = 'Title Page';

        return $data;
    }
}