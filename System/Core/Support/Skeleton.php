<?php
namespace Moon\Core\Support;

use Moon\Core\Facade\Moon;

class Skeleton 
{
    
    public function fillable(): array
    {
        return [
            "slug",
            "name",
            "slogan",
            "logo",
            "app",
            "libraries",
            "packages",
            "plugins",
            "themes",
            "widgets"
        ];
    }

    public function add( $key, $value ) {
        $this->{$key} = $value;
    }

    public function toArray() {
        return (array) $this;
    }

    public function toJSON() {
        return json_encode($this->toArray());
    }

    public function save($filename) {
        return Moon::load("temp")->file(__path("{tmp}"), $filename)->add($this->toJSON());
    }
}