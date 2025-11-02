<?php
namespace Moon\Http\Support;

class HomeSupport {

    public function index() {

        $data['title'] = 'Title Page';

        return $data;
    }
}