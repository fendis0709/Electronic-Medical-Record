<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Mail\Account_Verification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;

class Email_Controller extends Controller {

    public function send() {
        return view('coba.mail');
    }

    public function sendmail(Request $req) {
        $password = 'abcdef';
        $account = DB::table('users')->where('email', 'pasien@emr.com')->get();
        foreach($account as $r_acc){
            $name = $r_acc->name;
            $email = $r_acc->email;
        }

        $mail_param = new Account_Verification($name, $email, $password);
        $exe = Mail::to($req->input('to'))->send($mail_param);
        return var_dump($exe);
    }

    public function sendmail_2(Request $req) {
        $content = $req->input('content');

        Mail::send('emails.send', ['content' => $content], function (Request $req, $message) {
            $message->from('fendi.septiawan0709@gmail.com', 'Fendi Septiawan');
            $message->to($req->input('to'));
        });

        return response()->json(['message' => 'Request completed']);
    }

}
