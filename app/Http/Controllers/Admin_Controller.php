<?php

namespace App\Http\Controllers;

use Auth;
use Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
//use App\Patient;
//use App\Doctor;
//use App\Lab;
use App\User;

class Admin_Controller extends Controller {

    function auth() {
        if (Auth::guest()) {
//            return redirect()->action('User@login');
//            return redirect()->route('login');
//            return var_dump(Auth::guest());
//            return Redirect::route('login');
            return redirect('login');
        } elseif (Auth::user()->status == 'Admin') {
            //Access granted
        } elseif (Auth::user()->status == 'Doctor') {
            return redirect('doctor');
        } elseif (Auth::user()->status == 'Lab') {
            return redirect('lab');
        } elseif (Auth::user()->status == 'Pharmacy') {
            return redirect('pharmacy');
        } elseif (Auth::user()->status == 'Patient') {
            return redirect('patient');
        }
    }

    //Untuk menampilkan dashboard admin master
    public function home() {
        if (Auth::guest() == TRUE || Auth::user()->status !== 'Admin') {
            return $this->auth();
        }

//        $get_

        return view('admin.home');
    }

    //Untuk menampilkan profil admin master
    public function profile() {
        $data['admin'] = DB::table('users')->where('id', Auth::user()->id)->get();

        return view('admin.profile', $data);
    }

    //Untuk mengedit profil admin
    public function profile_edit() {
        $data['admin'] = DB::table('users')->where('id', Auth::user()->id)->get();

        return view('admin.edit-profile', $data);
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

        return redirect('admin/profile')->with('message', 'Profil Anda telah berhasil diperbarui.');
    }

    //Untuk mengedit password admin
    public function password_edit() {
        return view('admin.edit-password');
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
                return redirect('admin/profile')->with('message', 'Password Anda telah diperbarui.');
            } else {
                return Redirect::back()->with('message', 'Password Anda tidak sesuai.');
            }
        } else {
            return Redirect::back()->with('message', 'Password Anda tidak sesuai.');
        }
    }

    /*
     * Untuk menambahkan dokter
     */

    public function doctor_add() {
        return view('doctor.add');
    }

    /*
     * Untuk memanajemen dokter
     */

    public function doctor_manage() {
        return view('doctor.manage');
    }

    /*
     * Untuk menambahkan laboratorium
     */

    public function lab_add() {
        return view('lab.add');
    }

    /*
     * Untuk memanajemen laboratorium
     */

    public function lab_manage() {
        return view('lab.manage');
    }

    /*
     * Untuk menambahkan farmasi
     */

    public function pharmacy_add() {
        return view('pharmacy.add');
    }

    /*
     * Untuk memanajemen farmasi
     */

    public function pharmacy_manage() {
        return view('pharmacy.manage');
    }

}
