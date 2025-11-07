<?php
namespace Moon\Http\Support\Admin;

class HomeSupport {

    public function index() {
        $data['title'] = 'Admin';

        return $data;
    }
}