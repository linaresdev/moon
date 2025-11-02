<?php
namespace Moon\Http\Controllers;

use Moon\Http\Support\AccountSupport;

class AccountController extends Controller {

    public function __construct( AccountSupport $app ) {
        $this->boot($app);
    }

    public function login() {
        return $this->render('login', $this->app->login());
    }
}