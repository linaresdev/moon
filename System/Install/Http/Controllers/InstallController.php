<?php
namespace Moon\Install\Http\Controllers;

use Illuminate\Http\Request;
use Moon\Install\Http\Support\InstallSupport;

class InstallController extends Controller
{
    public function __construct( InstallSupport $app ) {
        $this->app = $app;
    }

    public function index() {
        return $this->render("home", $this->app->index());
    }

    public function confirm() {
        return $this->app->confirm();
    }

    ## ENVIRONMENT
    public function env() {
        return $this->render("env", $this->app->env());
    }
    public function envUpdate(Request $request) {
        return $this->app->envUpdate($request);
    }

    ## Database
    public function database() {
        return $this->render("database", $this->app->database());
    }

    public function migrate() {
        return $this->app->migrate();
    }

    public function migrateReset() {
        return $this->app->migrateReset();
    }
    public function migrateRefresh() {
        return $this->app->migrateRefresh();
    }

    ## Account
    public function account() {
        return $this->render("account", $this->app->account());
    }
}