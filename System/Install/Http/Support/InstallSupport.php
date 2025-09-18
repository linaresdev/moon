<?php
namespace Moon\Install\Http\Support;

use Moon\Facade\Moon;
//use Illuminate\Support\Facades\Artisan;

class InstallSupport
{

    public function index() {
        $data['title'] = 'Title Page';
        return $data;
    }

    public function confirm()
    {
        if( !app("files")->exists(__path("{public}/cdn")) )
        {            
            app("files")->makeDirectory( 
                __path("{public}/cdn"),  $mode = 0775, $recursive = true
            );
        }
 
        \Artisan::call("vendor:publish", ["--tag" => "public", "--force" => true]);
        
        return redirect(__url("install/env"));
    }

    public function env() 
    {        
        $data['title']  = __("Ambiente Laravel");
        $data["env"]    = app("files")->get(base_path('.env'));

        return $data;
    }

    public function envUpdate( $request ) 
    {
        if( !empty( ($env = $request->editor)) )  {
            app("files")->put(base_path('.env'), $env);
        }

        return back();
    }

    public function isMigrate() {
        try {
            if(\Schema::hasTable("migrations")) {
                return (app("db")->table("migrations")->count() == 0);
            }
        } catch (\Throwable $th) {
            return false;
        }
    }
    public function database()
    { 
        $data['title']      = __('Base de datos');
        $data['ismigrate']  = $this->isMigrate();

        return $data;
    }

    public function testConnect($driver) {
        try {

            $DB = \DB::connection($driver);

           // dd($DB->getPdo());

           return true;

        } catch (\Throwable $th) {
            return false;
        }
    }
    public function migrate()
    {
        \Artisan::call("migrate");

        return back();
    }
    public function migrateRefresh()
    {
        \Artisan::call("migrate:refresh");       

        return back();
    }
    public function migrateReset()
    {
        \Artisan::call("migrate:reset");

        return back();
    }

    public function account()
    { 
        $data['title']      = __('Cuenta administrativa');
        $data['ismigrate']  = $this->isMigrate();

        return $data;
    }
}