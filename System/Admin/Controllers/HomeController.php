<?php
namespace Moon\Admin\Controllers;

use Moon\Admin\Supports\HomeSupport;

class HomeController extends Controller {

    public function __construct( HomeSupport $app ) {
        $this->boot($app);
    }

    public function index() {
        return $this->render('home', $this->app->index());
    }
}