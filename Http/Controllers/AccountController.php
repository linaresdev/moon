<?php
namespace Moon\Http\Controllers;

use Moon\Http\Requests\LoginRequest;
use Moon\Http\Support\AccountSupport;

class AccountController extends Controller {

    public function __construct( AccountSupport $app ) {
        $this->boot($app);
    }

    public function login() {
        return $this->render('login', $this->app->login());
    }
    public function postLogin( LoginRequest $request ) {
        return $this->app->attempt( $request );
    }

    public function logout() {
        return $this->app->logout();
    }
}