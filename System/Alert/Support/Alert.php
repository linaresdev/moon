<?php
namespace Moon\Alert\Support;

class Alert {
    protected $session;

    protected $taggs = [
    ];

    protected $systems = [
        "warning",
        "info",
        "danger",
        "success"
    ];

    public function __construct($app) {
        $this->session = $app["session"];

        foreach( $this->systems as $key => $alert )
        {
            if( $this->session->has($alert) ) 
            {
                $this->taggs["system"][$key] = [
                    "style"     => "alert alert-$alert",
                    "title"     => ucwords($alert),
                    "message"   => $this->session->get($alert),
                ];
            }
        }
    }

    public function listener($tag, $path=null)
    {
        if( array_key_exists( $tag, $this->taggs ) )
        {
            $views = null;

            if( !empty($this->taggs[$tag]) ) {
                foreach( $this->taggs[$tag] as $data ) {
                    $views .= $this->render($path, $data);
                }
            }

            return $views;
        }
    }

    public function render( $view, $data=[], $merger=[] )
    {
        if( view()->exists($view) ) {
            return view($view, $data, $merger);
        }

        return "La vista $view no existe";
    }

    public function index() {
        return "Hola Numdo";
    }
}