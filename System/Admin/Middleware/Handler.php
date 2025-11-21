<?php
namespace Moon\Admin\Middleware;

class Handler 
{
    public function start() {
        return [
        ];        
    }

    public function groups() {
        return [
            "moon" => [
                \Moon\Http\Middleware\AuthMiddleware::class,
            ]
        ];
    }

    public function routes() {
        return [
        ];
    }
}