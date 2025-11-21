<?php
namespace Moon\Admin\Supports;

class HomeSupport {

    public function index() {

        $data['title'] = 'Title Page';

        return $data;
    }
}