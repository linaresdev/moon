<?php
namespace Moon\Admin\Mails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Getmembership extends Mailable {

    use Queueable, SerializesModels;

    public $hash;

    public $user;

    public function __construct( $hash, $user ) {
        $this->hash = $hash;
        $this->user = $user;
    }

    public function build() {
        return $this->view("admin::mails.getmembership");
    }
}