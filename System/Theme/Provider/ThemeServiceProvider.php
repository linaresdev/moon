<?php
namespace Moon\Theme\Provider;

use Illuminate\Support\ServiceProvider;

class ThemeServiceProvider extends ServiceProvider {

    public function boot() {
        dd("Theme");
    }

    public function register() {}
}