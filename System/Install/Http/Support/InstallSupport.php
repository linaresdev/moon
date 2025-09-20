<?php
namespace Moon\Install\Http\Support;

use Moon\Facade\Moon;
use Moon\Core\Support\Skeleton;
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
        else {
            return back()->with(
                "danger", "Error al tratar de aplicar los cambios"
            );
        }

        return back()->with(
            "success", "Cambios aplicados correctamente"
        );
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

        return back()->with(
            "success", "Migraciones aplicada correctamente"
        );
    }
    public function migrateRefresh()
    {
        \Artisan::call("migrate:refresh");       

        return back()->with(
            "success", "Refrescado de la migraciones aplicada correctamente"
        );
    }
    public function migrateReset()
    {
        \Artisan::call("migrate:reset");

        return back()->with(
            "success", "Remover migraciones aplicada correctamente"
        );
    }

    public function account()
    { 
        $data['title']      = __('Cuenta administrativa');
        $data['ismigrate']  = $this->isMigrate();

        return $data;
    }

    public function accountCreate($request) 
    {   
        $file = __path("{tmp}/app.json");
        $user = app("db")->table("users");

        $account = $user->insert([
            "name" => $request->firstname.' '.$request->lastname,
            "email" => $request->email,
            "password" => \Hash::make($request->password),
            "activated" => 1,
            "meta" => json_encode([
                "rol" => "admin",
                "rols" => [
                    "owner" => ["view" => 1, "insert"=>1,"update"=>1,"delete"=>1]  ,      
                    "user" => ["view" => 1, "insert"=>1,"update"=>1,"delete"=>1],
                    "admin" => ["view" => 1, "insert"=>1,"update"=>1,"delete"=>1]
                ]
            ]),
        ]);

        if( $account )
        {
            $app = new Skeleton;
    
            $app->add("slug", \Str::slug(env("APP_NAME")));
            $app->add("brand", $request->appname);
            $app->add("slogan", $request->slogan);
            $app->add("logo", '{cdn}/logo.png');
    
            $app->add("app", [
                'type'      => 'package',
                'slug'      => 'install',
                'driver'    => \Moon\Driver::class,
                'token'     => "APP_MOON_TOKEN",
                'activated' => 1
            ]);
    
            ## Libraries
            $app->add("libraries", [
                \Moon\Alert\Driver::class,
            ]);
    
            ## Packages
            $app->add("packages", []);
    
            # Plugins
            $app->add("plugins", []);
    
            # Themes
            $app->add("themes", []);
    
            # Widgets
            $app->add("widgets", []);
    
            if($app->save("app.json")) {
                return redirect(__url('/'));
            }
        }

        return back();
    }
}