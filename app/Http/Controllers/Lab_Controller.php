<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Lab;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
//use Illuminate\Support\Facades\Storage;

class Lab_Controller extends Controller {

    function auth() {
        if (Auth::guest()) {
            return redirect('login');
        } elseif (Auth::user()->status == 'Admin') {
            return redirect('admin');
        } elseif (Auth::user()->status == 'Doctor') {
            return redirect('doctor');
        } elseif (Auth::user()->status == 'Lab') {
            //Access granted
        } elseif (Auth::user()->status == 'Pharmacy') {
            return redirect('pharmacy');
        } elseif (Auth::user()->status == 'Patient') {
            return redirect('patient');
        }
    }

    //Untuk menampilkan dashboard lab
    public function home() {
        $lab_id = DB::table('lab')->where('user_id', Auth::user()->id)->value('id');
        $data['today_checkup_count'] = DB::table('lab_checkup')->where('lab_id', $lab_id)->where('date', date('Y-m-d'))->count();
        $data['next_checkup_count'] = DB::table('lab_checkup')->where('lab_id', $lab_id)->where('date', (new DateTime('+1 day'))->format('Y-m-d'))->count();
        $data['completed_checkup_count'] = DB::table('lab_checkup')->where('lab_id', $lab_id)->where('date', '<', date('Y-m-d'))->count();

        return view('lab.home', $data);
    }

    //Untuk memanajemen data lab
    public function manage() {
        if (Auth::guest() == TRUE || Auth::user()->status !== 'Admin') {
            return $this->auth();
        }

        $lab = DB::table('users')->join('lab', 'users.id', '=', 'lab.user_id')->where('users.is_enabled', '=', '1')->get();

        $data = array(
            'lab' => $lab
        );

        return view('lab.manage', $data);
    }

    //Untuk menampilkan form tambah lab
    public function lab_add() {
        if (Auth::guest() == TRUE || Auth::user()->status !== 'Admin') {
            return $this->auth();
        }

        return view('lab.add');
    }

    //Menyimpan data lab ke database
    public function lab_add_submit(Request $request) {
        $password = explode("@", $request->input('email'));
        $pass = $password[0];

        $account = new User;

        $account->email = $request->input('email');
        $account->password = password_hash($pass, PASSWORD_DEFAULT);
        $account->name = $request->input('name');
        $account->city = $request->input('city');
        $account->address = $request->input('address');
        $account->mobile = $request->input('mobile');
        $account->telephone = $request->input('telephone');
        $account->status = 'Lab';
        $account->remember_token = md5(date('Y-m-d H:i:s'));

        $account->save();

        $request->file('photo')->storeAs(('/assets/userfile/lab'), md5($request->input('email')) . '.' . $request->file('photo')->extension());

        $lab = new Lab(
                array(
            'name' => $request->input('name'),
            'mobile' => $request->input('mobile'),
            'telephone' => $request->input('telephone'),
            'city' => $request->input('city'),
            'address' => $request->input('address'),
            'photo' => '/storage/assets/userfile/lab/' . md5($request->input('email')) . '.' . $request->file('photo')->extension()
                )
        );

        $account_lab = $account::where('email', $request->input('email'))->first();
        $account_lab->lab()->save($lab);

        return Redirect::back()->with('message', 'Data laboratorium ' . $request->input('name') . ' telah berhasil ditambahkan.');
    }

    //Untuk menampilkan profile laboratorium
    public function profile($id = NULL) {
        if (Auth::guest() == TRUE || ( Auth::user()->status !== 'Lab' && Auth::user()->status !== 'Admin')) {
            return $this->auth();
        }

        if ($id == NULL) {
            $lab = DB::table('lab')->where('user_id', '=', Auth::user()->id)->get();
            $account = DB::table('users')->where('id', '=', Auth::user()->id)->where('is_enabled', '1')->get();
        } else {
            $lab = DB::table('lab')->where('id', '=', $id)->get();
            $lab_id = DB::table('lab')->where('id', '=', $id)->value('user_id');
            $account = DB::table('users')->where('id', '=', $lab_id)->where('is_enabled', '1')->get();
        }

        $data = array(
            'lab' => $lab,
            'account' => $account
        );

        return view('lab.profile', $data);
    }

    //Untuk menampilkan form edit profil lab
    public function profile_edit($id = NULL) {
        if (Auth::guest() == TRUE || (Auth::user()->status !== 'Lab' && Auth::user()->status !== 'Admin')) {
            return $this->auth();
        }

        if ($id == NULL) {
            $lab = DB::table('lab')->where('user_id', '=', Auth::user()->id)->get();
            $account = DB::table('users')->where('id', '=', Auth::user()->id)->get();
        } else {
            $lab = DB::table('lab')->where('id', '=', $id)->get();
            $lab_id = DB::table('lab')->where('id', '=', $id)->value('user_id');
            $account = DB::table('users')->where('id', '=', $lab_id)->where('is_enabled', '1')->get();
        }

        $data = array(
            'lab' => $lab,
            'account' => $account
        );

        return view('lab.edit-profile', $data);
    }

    //Untuk menyimpan data perubahan profil lab
    public function profile_edit_submit(Request $request) {
        $lab = new Lab;

        $email = $request->input('email');

        $user_id = DB::table('users')->where('email', $email)->value('id');

        $lab->where('user_id', $user_id)->update(
                array(
                    'name' => $request->input('name'),
                    'city' => $request->input('city'),
                    'address' => $request->input('address'),
                    'mobile' => $request->input('mobile'),
                    'telephone' => $request->input('telephone')
                )
        );

        $user = new User;

        $user->where('id', $user_id)->update(
                array(
                    'name' => $request->input('name'),
                    'city' => $request->input('city'),
                    'address' => $request->input('address'),
                    'mobile' => $request->input('mobile'),
                    'telephone' => $request->input('telephone')
                )
        );

        if (Auth::user()->status == 'Lab') {
            return redirect('lab/profile')->with('message', 'Profil Anda telah berhasil diperbarui.');
        }

        return redirect('admin/lab/manage')->with('message', 'Data laboratorium ' . $request->input('name') . ' telah berhasil diperbarui.');
    }

    //Untuk mengedit password lab
    public function password_edit() {
        if (Auth::guest() == TRUE || Auth::user()->status !== 'Lab') {
            return $this->auth();
        }

        return view('lab.edit-password');
    }

    //Untuk memproses form edit password pasien - Hanya untuk Pasien
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
                return redirect('lab/profile')->with('message', 'Password Anda telah diperbarui.');
            } else {
                return Redirect::back()->with('message', 'Password Anda tidak sesuai.');
            }
        } else {
            return Redirect::back()->with('message', 'Password Anda tidak sesuai.');
        }

        return redirect('lab/profile')->with('message', 'Password Anda berhasil diperbarui.');
    }

    //Untuk menghapus data lab
    public function delete($id) {
        if (Auth::guest() == TRUE || Auth::user()->status !== 'Admin') {
            return $this->auth();
        }

        $user_id = DB::table('lab')->where('id', $id)->value('user_id');
        $lab_name = DB::table('lab')->where('id', $id)->value('name');
        DB::table('users')->where('id', $user_id)->update(array('is_enabled' => '0'));

        return redirect('admin/lab/manage')->with('message', 'Data laboratorium ' . $lab_name . ' telah berhasil dihapus.');
    }

}
