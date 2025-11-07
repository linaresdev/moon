<?php
namespace Moon\Http\Controllers\Admin;

use Moon\Http\Support\Admin\HomeSupport;

class HomeController extends Controller {

    public function __construct( HomeSupport $app ) {
        $this->boot($app);
    }

    public function home() {
        return $this->render('home', $this->app->index());
    }
}