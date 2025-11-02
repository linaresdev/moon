<?php
namespace Moon\Http\Support;

class AccountSupport {

    public function index() {

        $data['title'] = 'Title Page';

        return $data;
    }

    public function login() {

        $data['title'] = __("Login");

        return $data;
    }
}