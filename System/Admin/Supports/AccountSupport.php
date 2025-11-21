<?php
namespace Moon\Admin\Supports;

use Moon\Admin\Mails\Getmembership;
use Illuminate\Support\Facades\Mail;

class AccountSupport {

    protected $skin;

    public function __construct() {
        $this->style = app("skin")->style;
    }

    public function login()
    {
        app("skin")->style->add(
            "wrapper", "col-lg-6 offset-lg-6 pt-5 col-md-12"
        );

        $this->style->add(
            "account", " border-bottom mb-3 p-3"
        );

        $data['title'] = __("auth.login");        

        return $data;
    }

    public function getmembership()
    {
        $this->style->add(
            "wrapper", "col-lg-6 col-md-12"
        );

        $this->style->add(
            "account", "my-5 p-3"
        );

        $data['title'] = __("auth.getmembership");

        return $data;
    }

    public function postGetmembership( $request )
    {
        $userJob    = new \Moon\Model\UserJob();

        $hash       = base64_encode(($email = $request->email));

        $user       = $userJob->create([
            "type"      => $request->type,
            "email"     => $email,
            "subject"   => $request->fullname,
            "zip"       => \Hash::make($hash),
            "meta"      => get_user_guard()
        ]);

        if( $user ) 
        {
            Mail::to([$email])->send(
                new Getmembership($hash, $user)
            );

            return redirect(__url("login"));
        }

        return back();
    }
}