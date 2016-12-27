<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Mail\Account_Verification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use PHPMailer;

//require_once $_SERVER['DOCUMENT_ROOT'] . "/indonusa_project/vendor/autoload.php";

use Mailgun\Mailgun;

class Email_Controller extends Controller {

    public function send($name = "Joko", $email = "fendi.septiawan0709.02@gmail.com", $password = "ABCDEF") {
        $mail = new PHPMailer;

        //Enable SMTP debugging. 
        $mail->SMTPDebug = 3;
        //Set PHPMailer to use SMTP.
        $mail->isSMTP();
        //Set SMTP host name                          
        $mail->Host = "smtp.gmail.com";
        //Set this to true if SMTP host requires authentication to send email
        $mail->SMTPAuth = true;
        //Provide username and password     
        $mail->Username = "fendi.septiawan0709@gmail.com";
        $mail->Password = "ciqxlyaimkwzoizi";
        //If SMTP requires TLS encryption then set it
        $mail->SMTPSecure = "tls";
        //Set TCP port to connect to 
        $mail->Port = 587;

        $mail->From = "administrator@emr.com";
        $mail->FromName = "Electronic Medical Record - Aktivasi Akun";

        $mail->addAddress($email, $name);

        $mail->isHTML(true);

        $mail->Subject = "Subject Text";
        $mail->Body = "<div style='font-size: 14px'><p>Hai, " . $name . ".</p><p>Selamat datang di Electronic Medical Record (EMR).<p>Untuk dapat menggunakan akun Anda, silakan login dengan <br/>Email : " . $email . ".<br/>Password : " . $password . ".</p><p>Harap ganti password Anda segera setelah login.</p><p>Terima kasih.</p>";
        $mail->AltBody = "Hai, " . $name . ". Selamat datang di Electronic Medical Record (EMR). Untuk dapat menggunakan akun Anda, silakan login dengan email : " . $email . ". password : " . $password . ". Harap ganti password Anda segera setelah login. Terima kasih.";

        if (!$mail->send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
            echo "Message has been sent successfully";
        }
    }

    public function send_old() {
        $mgClient = new Mailgun('key-4fa27002dae34b70ba18302e4bce2904');
        $domain = "sandbox2edbc530d219499aa8b385d4a83430cf.mailgun.org";

        $result = $mgClient->sendMessage($domain, array(
            'from' => 'Excited User <emr@indonusa.com>',
            'to' => 'Baz <fendi.septiawan0709@gmail.com>',
            'subject' => 'Hello',
            'text' => 'Testing some Mailgun awesomness!'
        ));

        return var_dump($result);
    }

    public function sends() {
        return view('coba.mail');
    }

    public function sendmail(Request $req) {
        $password = 'abcdef';
        $account = DB::table('users')->where('email', 'pasien@emr.com')->get();
        foreach ($account as $r_acc) {
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
