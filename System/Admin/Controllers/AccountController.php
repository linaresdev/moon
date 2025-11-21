<?php
namespace Moon\Admin\Controllers;

use Moon\Admin\Supports\AccountSupport;
use Moon\Admin\Requests\GetmembershipRequest;

class AccountController extends Controller {

    public function __construct( AccountSupport $app ) {
        $this->boot($app);
    }

    public function login() {
        return $this->render('login', $this->app->login());
    }

    public function getmembership() {
        return $this->render('getmembership', $this->app->getmembership());
    }
    
    public function postGetmembership( GetmembershipRequest $request ) {
        return $this->app->postGetmembership( $request );
    }
}