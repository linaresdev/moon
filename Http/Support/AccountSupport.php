<?php
namespace Moon\Http\Support;

use Illuminate\Support\Facades\Auth;

class AccountSupport {

    public function index() {

        $data['title'] = 'Title Page';

        return $data;
    }

    public function login() 
    {
        $data['title'] = __("Login");

        return $data;
    }

    public function attempt( $request )
    {
        $data["user"]       = $request->user;
        $data["password"]   = $request->pwd;
        
        if( Auth::attempt( $data ) )
        {
            $user = $request->user();
            
            if( ($activated = $user->activated) == 1 ) {
                return redirect()->intended('/');
            }

            foreach( [0,2,3,4] as $state ) 
            {
                if( $activated  ==  $state ) {

                    Auth::logout();

                    $request->add("nologin", __("auth.activated.$state"));

                    return back()->withErrors($request->errors());
                }
            }


            $user = (new User)->find( $request->user()->id );

        }   

        $request->add("nologin", __("auth.bad"));

        return back()->withErrors($request->errors());
    }

    public function logout()
    {
        if( auth()->check() )
        {
            $user = request()->user(); 

            Auth::logout();
    
            return redirect('login');
        }

        return back();
    }
}