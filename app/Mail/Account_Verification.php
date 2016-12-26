<?php

namespace App\Mail;

//use App\User;
//use Illuminate\Http\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
//use Illuminate\Contracts\Queue\ShouldQueue;

class Account_Verification extends Mailable {

    use Queueable,
        SerializesModels;
    
    protected $name;
    protected $email;
    protected $pass;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $email, $pass) {
        $this->name = $name;
        $this->email = $email;
        $this->pass = $pass;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        return $this->view('account.email-verification')->with(array(
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->pass
        ));
    }

}
