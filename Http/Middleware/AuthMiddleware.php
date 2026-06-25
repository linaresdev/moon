<?php
namespace Moon\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthMiddleware {

    protected $exerts = [
        "login",
        "logout",
        "getmembership"
    ];

    public function handle( $request, Closure $next, $guard = 'web') 
    {
        if( ($AUTH = Auth::guard($guard))->guest() && !$this->isExert($request) )
        {
            return redirect("login");
        }
        else {
            $data["login"] = $AUTH->user();
            
            app("view")->share($data);
        }
        
        return $next( $request );
    }

    public function isExert($request)
    {
        $out = false;
        
        foreach( $this->exerts as $exert )
        {
            if(\Str::is($exert, $request->path())) {
                return true;
            }
        }

        return $out;
    }
}