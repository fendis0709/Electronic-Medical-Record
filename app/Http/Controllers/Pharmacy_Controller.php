<?php

namespace App\Http\Controllers;

use App\User;
//use App\Pharmacy;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Mail\Account_Verification;
use PHPMailer;

class Pharmacy_Controller extends Controller {
    /*
     * Untuk menampilkan dashboard farmasi
     */

    public function home() {
        return view('pharmacy.home');
    }

    /*
     * Untuk menampilkan profil farmasi
     */

    public function profile($id = NULL) {
        if ($id == NULL) {
            $data['pharmacy'] = DB::table('users')->where('status', 'Pharmacy')->where('id', Auth::user()->id)->get();
        } else {
            $data['pharmacy'] = DB::table('users')->where('status', 'Pharmacy')->where('id', $id)->get();
        }

        return view('pharmacy.profile', $data);
    }

    /*
     * Untuk mengedit profil farmasi
     */

    //Untuk menampilkan form tambah farmasi - Hanya untuk admin
    public function pharmacy_add() {
        if (Auth::guest() == TRUE || Auth::user()->status !== 'Admin') {
            return $this->auth();
        }
        return view('pharmacy.add');
    }

    public function pharmacy_add_submit(Request $req) {

        $password = $this->generate_pass();

        $phar = new User;

        $phar->email = $req->input('email');
        $phar->password = password_hash($password, PASSWORD_DEFAULT);
        $phar->name = $req->input('name');
        $phar->city = $req->input('city');
        $phar->address = $req->input('address');
        $phar->mobile = $req->input('mobile');
        $phar->telephone = $req->input('telephone');
        $phar->status = 'Pharmacy';

        $phar->save();

        $this->sendmail($request->input('name'), $request->input('email'), $password);

        return redirect('admin/pharmacy/add')->with('message', 'Farmasi telah ditambahkan');
    }

    public function generate_pass($length = 15) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function sendmail($name, $email, $password) {
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

    public function sendmail_mailgun($name, $email, $pass) {
        $mail_param = new Account_Verification($name, $email, $pass);
        Mail::to($email)->send($mail_param);
    }

    public function profile_edit($id = NULL) {
        if ($id == NULL) {
            $data['pharmacy'] = DB::table('users')->where('id', Auth::user()->id)->get();
        } else {
            $data['pharmacy'] = DB::table('users')->where('id', $id)->get();
        }

        return view('pharmacy.edit-profile', $data);
    }

    public function profile_edit_submit(Request $req) {
        $user = new User;

        $email = $req->input('email');

        $user->where('email', $email)->update(
                array(
                    'name' => $req->input('name'),
                    'city' => $req->input('city'),
                    'address' => $req->input('address'),
                    'telephone' => $req->input('telephone'),
                    'mobile' => $req->input('mobile')
        ));

        if (Auth::user()->status == 'Pharmacy') {
            return redirect('pharmacy/profile')->with('message', 'Profil Anda telah diperbarui.');
        }

        return redirect('admin/pharmacy/manage')->with('message', 'Farmasi ' . $req->input('name') . ' telah diperbarui.');
    }

    /*
     * Untuk mengedit password farmasi
     */

    public function password_edit() {
        return view('pharmacy.edit-password');
    }

    public function password_edit_submit(Request $req) {
        $email = $req->input('email');
        $cur_password = $req->input('password');
        $get_old_pass = DB::table('users')->where('email', $email)->value('password');
        $check = password_verify($cur_password, $get_old_pass);
        if ($check == TRUE) {
            $new_password = $req->input('password_new');
            $ver_new_password = $req->input('password_new_verify');
            if ($new_password == $ver_new_password) {
                $admin = new User;
                $admin->where('email', $email)->update(array('password' => password_hash($new_password, PASSWORD_DEFAULT)));
                return redirect('pharmacy/profile')->with('message', 'Password Anda telah diperbarui.');
            } else {
                return Redirect::back()->with('message', 'Password Anda tidak sesuai.');
            }
        } else {
            return Redirect::back()->with('message', 'Password Anda tidak sesuai.');
        }

        return redirect('pharmacy/profile')->with('message', 'Password Anda berhasil diperbarui.');
    }

    public function manage() {
        $data['pharmacy'] = DB::table('users')->where('status', 'Pharmacy')->where('is_enabled', '1')->get();

        return view('pharmacy.manage', $data);
    }

    public function delete($id) {
        if (Auth::guest() == TRUE || Auth::user()->status !== 'Admin') {
            return $this->auth();
        }

        $pharmacy_name = DB::table('users')->where('id', $id)->value('name');
        DB::table('users')->where('id', $id)->update(array('is_enabled' => '0'));

        return redirect('admin/pharmacy/manage')->with('message', 'Data farmasi \'' . $pharmacy_name . '\' telah berhasil dihapus.');
    }

}
