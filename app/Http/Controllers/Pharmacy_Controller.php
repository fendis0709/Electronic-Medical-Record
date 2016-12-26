<?php

namespace App\Http\Controllers;

use App\User;
//use App\Pharmacy;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Mail\Account_Verification;

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

    public function sendmail($name, $email, $pass) {
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
