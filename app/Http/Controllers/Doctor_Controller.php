<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class Doctor_Controller extends Controller {

    function auth() {
        if (Auth::guest()) {
            return redirect('login');
        } elseif (Auth::user()->status == 'Admin') {
            return redirect('admin');
        } elseif (Auth::user()->status == 'Doctor') {
            //Access granted
        } elseif (Auth::user()->status == 'Lab') {
            return redirect('lab');
        } elseif (Auth::user()->status == 'Pharmacy') {
            return redirect('pharmacy');
        } elseif (Auth::user()->status == 'Patient') {
            return redirect('patient');
        }
    }

    //Untuk menampilkan dashboard dokter
    public function home() {
        if (Auth::guest() == TRUE || Auth::user()->status !== 'Doctor') {
            return $this->auth();
        }

        $doctor = DB::table('users')->join('doctor', 'users.id', '=', 'doctor.user_id')->where('users.is_enabled', '=', '1')->get();

        $data = array(
            'doctor' => $doctor
        );
        return view('doctor.home', $data);
    }

    //Untuk menampilkan data dokter
    public function manage() {
        if (Auth::guest() == TRUE || Auth::user()->status !== 'Admin') {
            return $this->auth();
        }

        $doctor = DB::table('users')->join('doctor', 'users.id', '=', 'doctor.user_id')->where('users.is_enabled', '=', '1')->get();

        $data = array(
            'doctor' => $doctor
        );

        return view('doctor.manage', $data);
    }

    //Untuk menampilkan form tambah dokter - Hanya Admin
    public function doctor_add() {
        if (Auth::guest() == TRUE || Auth::user()->status !== 'Admin') {
            return $this->auth();
        }

        return view('doctor.add');
    }

    //Untuk menambahkan dokter - Hanya Admin
    public function doctor_add_submit(Request $request) {
        $password = explode("@", $request->input('email'));
        $pass = $password[0];
        //Insert into Account table
        $account = new User;

        $account->email = $request->input('email');
        //Password will be added when user's first login.
        $account->password = password_hash($pass, PASSWORD_DEFAULT);
        $account->name = $request->input('name');
        $account->city = $request->input('city');
        $account->address = $request->input('address');
        $account->mobile = $request->input('mobile');
        $account->telephone = $request->input('telephone');
        $account->remember_token = md5(date('Y-m-d H:i:s'));
        $account->status = 'Doctor';
        $account->created_at = date('Y-m-d H:i:s');
        $account->updated_at = date('Y-m-d H:i:s');

        $account->save();

        //Insert into Doctor table
        $birth_date = explode('/', $request->input('birth_date'));
        $birth_date_db = $birth_date[2] . '-' . $birth_date[0] . '-' . $birth_date[1];

        $request->file('photo')->storeAs(('/assets/userfile/doctor'), md5($request->input('email')) . '.' . $request->file('photo')->extension());

        $doctor = new Doctor(
                array(
            'name' => $request->input('name'),
            'gender' => $request->input('gender'),
            'birth_date' => $birth_date_db,
            'specialization' => $request->input('specialization'),
            'city' => $request->input('city'),
            'address' => $request->input('address'),
            'mobile' => $request->input('mobile'),
            'telephone' => $request->input('telephone'),
            'photo' => '/storage/assets/userfile/doctor/' . md5($request->input('email')) . '.' . $request->file('photo')->extension()
                )
        );

        $account_doctor = $account::where('email', $request->input('email'))->first();
        $account_doctor->doctor()->save($doctor);

        return Redirect::back()->with('message', 'Data dokter ' . $request->input('name') . ' telah berhasil ditambahkan.');
    }

    //Untuk menampilkan profil dokter
    public function profile($id = NULL) {
        if (Auth::guest() == TRUE || (Auth::user()->status !== 'Doctor' && Auth::user()->status !== 'Admin')) {
            return $this->auth();
        }
        if ($id == NULL) {
            $doctor = DB::table('doctor')->where('user_id', Auth::user()->id)->get();
            $account = DB::table('users')->where('id', Auth::user()->id)->get();
        } else {
            $doctor = DB::table('doctor')->where('id', '=', $id)->get();
            $doctor_id = DB::table('doctor')->where('id', '=', $id)->value('user_id');
            $account = DB::table('users')->where('id', '=', $doctor_id)->get();
        }

        $data = array(
            'doctor' => $doctor,
            'account' => $account
        );

        return view('doctor.profile', $data);
    }

    //Untuk mengedit profil dokter
    public function profile_edit($id = NULL) {
        if (Auth::guest() == TRUE || (Auth::user()->status !== 'Doctor' && Auth::user()->status !== 'Admin')) {
            return $this->auth();
        }

        if ($id == NULL) {
            $doctor = DB::table('doctor')->where('user_id', Auth::user()->id)->get();
            $account = DB::table('users')->where('id', Auth::user()->id)->get();
        } else {
            $doctor = DB::table('doctor')->where('id', '=', $id)->get();
            $doctor_id = DB::table('doctor')->where('id', '=', $id)->value('user_id');
            $account = DB::table('users')->where('id', '=', $doctor_id)->get();
        }

        $data = array(
            'doctor' => $doctor,
            'account' => $account
        );

        return view('doctor.edit-profile', $data);
    }

    //Untuk memproses form edit profil dokter - Untuk Admin dan Dokter
    public function profile_edit_submit(Request $request) {
        $doctor = new Doctor;

        $email = $request->input('email');

        $user_id = DB::table('users')->where('email', $email)->value('id');

        $doctor->where('user_id', $user_id)->update(
                array(
                    'name' => $request->input('name'),
                    'gender' => $request->input('gender'),
                    'specialization' => $request->input('specialization'),
                    'birth_date' => date('Y-m-d', strtotime($request->input('birth_date'))),
                    'city' => $request->input('city'),
                    'address' => $request->input('address'),
                    'mobile' => $request->input('mobile'),
                    'telephone' => $request->input('telephone'),
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

        if (Auth::user()->status == 'Doctor') {
            return redirect('doctor/profile')->with('message', 'Profil Anda telah berhasil diperbarui.');
        }

        return redirect('admin/doctor/manage')->with('message', 'Data dokter ' . $request->input('name') . ' telah berhasil diperbarui.');
    }

    //Untuk mengedit password dokter - Hanya untuk dokter
    public function password_edit() {
        if (Auth::guest() == TRUE || Auth::user()->status !== 'Doctor') {
            return $this->auth();
        }

        return view('doctor.edit-password');
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
                return redirect('doctor/profile')->with('message', 'Password Anda telah diperbarui.');
            } else {
                return Redirect::back()->with('message', 'Password Anda tidak sesuai.');
            }
        } else {
            return Redirect::back()->with('message', 'Password Anda tidak sesuai.');
        }

        return redirect('doctor/profile')->with('message', 'Password Anda berhasil diperbarui.');
    }

    public function delete($id) {
        if (Auth::guest() == TRUE || Auth::user()->status !== 'Admin') {
            return $this->auth();
        }

        $user_id = DB::table('doctor')->where('id', $id)->value('user_id');
        $doctor_name = DB::table('doctor')->where('id', $id)->value('name');
        DB::table('users')->where('id', $user_id)->update(array('is_enabled' => '0'));

        return redirect('admin/doctor/manage')->with('message', 'Data dokter ' . $doctor_name . ' telah berhasil dihapus.');
    }

    public function my_patient() {
        $user_id = Auth::user()->id;
        $doctor_id = DB::table('doctor')->where('user_id', $user_id)->value('id');
        $data['result'] = DB::table('checkup')->join('patient', 'checkup.patient_id', '=', 'patient.id')->where('checkup.doctor_id', $doctor_id)->select('patient.*')->distinct()->get();

        return view('doctor.my-patient', $data);
    }

}
