<?php
namespace Moon\Http\Controllers;

use Project\Http\Support\HomeSupport;

class AccountController extends Controller {

    public function __construct( HomeSupport $app ) {
        $this->boot($app);
    }

    public function index() {
        return $this->render('home', $this->app->index());
    }
}