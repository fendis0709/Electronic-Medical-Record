<?php

namespace App\Http\Controllers;

use Auth;
use App\Lab;
//use App\User;
//use App\Doctor;
use App\Checkup;
//use App\Pharmacy;
use App\Lab_checkup;
use App\Prescription;
use App\Prescription_detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class Checkup extends Controller {

    //Untuk mengisi formulir pemeriksaan pasien
    public function step_1() {
        $data['doctor'] = DB::table('doctor')->where('user_id', Auth::user()->id)->value('id');
        $data['patient'] = DB::table('checkup')->join('patient', 'checkup.patient_id', '=', 'patient.id')->where('doctor_id', $data['doctor'])->where('date', date('Y-m-d'))->where('result', '=', NULL)->get();

        return view('checkup.doctor-1', $data);
    }

    public function step_1_submit(Request $req) {
        //update into table checkup
        $doctor_id = DB::table('doctor')->where('user_id', Auth::user()->id)->value('id');
        $patient_id = $req->input('patient');
        $result = $req->input('result');
        $notes = $req->input('notes');
        $symtomp = $req->input('symtomp');

        $checkup = new Checkup;

        $checkup->where('doctor_id', $doctor_id)->where('patient_id', $patient_id)->where('date', date('Y-m-d'))->update(
                array(
                    'symtomp' => $symtomp,
                    'result' => $result,
                    'note' => $notes
                )
        );

        $checkup_id = $checkup->where('doctor_id', $doctor_id)->where('patient_id', $patient_id)->where('date', date('Y-m-d'))->value('id');

        Session::set('checkup_id', $checkup_id);

        if ($req->input('category') == 'Lab') {
            //Input into lab_checkup table
            $lab = new Lab;

            $lab->checkup_id = $checkup_id;
            $lab->doctor_id = $doctor_id;
            $lab->patient_id = $patient_id;
            $lab->date = date('Y-m-d');

            $lab->save();

            return redirect(url('doctor/checkup/patient_2_lab'));
        } else {
            //Input into prescription table
            $prescription = new Prescription;

            $prescription->checkup_id = $checkup_id;
            $prescription->doctor_id = $doctor_id;
            $prescription->patient_id = $patient_id;
            $prescription->date = date('Y-m-d');

            $prescription->save();

            return redirect(url('doctor/checkup/patient_2_pharmacy'));
        }
    }

    public function step_2_lab() {
        $data['patient_id'] = DB::table('checkup')->where('id', Session::get('checkup_id'))->value('patient_id');
        $data['checkup'] = DB::table('checkup')->where('id', Session::get('checkup_id'))->get();
        $data['patient'] = DB::table('patient')->where('id', $data['patient_id'])->get();
        $data['lab'] = DB::table('lab')->get();

        return view('checkup.doctor-2-1', $data);
    }

    public function step_2_lab_submit(Request $req) {
        $checkup_id = Session::get('checkup_id');
        $lab_id = $req->input('lab');
        $patient_id = DB::table('checkup')->where('id', $checkup_id)->value('patient_id');
        $date = date('Y-m-d', strtotime($req->input('date')));

        //insert into table lab_checkup
        $lab_checkup = new Lab_checkup;

        $lab_checkup->checkup_id = $checkup_id;
        $lab_checkup->lab_id = $lab_id;
        $lab_checkup->patient_id = $patient_id;
        $lab_checkup->date = $date;

        $lab_checkup->save();

        $patient_name = DB::table('patient')->where('id', $patient_id)->value('name');

        Session::forget('checkup_id');

        return redirect(url('doctor/checkup/patient'))->with('message', 'Pemeriksaan pasien ' . $patient_name . ' telah selesai');
    }

    public function step_2_pharmacy() {
        if (NULL !== (Session::get('checkup_id'))) {
            //Use when user is checkup at doctor
            $data['patient_id'] = DB::table('checkup')->where('id', Session::get('checkup_id'))->value('patient_id');
            $data['prescription_id'] = DB::table('prescription')->where('checkup_id', Session::get('checkup_id'))->value('id');
            $data['checkup'] = DB::table('checkup')->where('id', Session::get('checkup_id'))->get();
            $data['patient'] = DB::table('patient')->where('id', $data['patient_id'])->get();
            $data['prescription_detail'] = DB::table('prescription_detail')->where('prescription_id', $data['prescription_id'])->get();
        } else {
            //Use when user is directly to pharmacy
        }

        return view('checkup.doctor-2-2', $data);
    }

    public function step_2_pharmacy_submit(Request $req) {
        $action = $req->input('action');

        $prescription_detail = new Prescription_detail;
        if (strtolower($action) == 'add') {
            //Lakukan penambahan resep obat

            $prescription_detail->prescription_id = $req->input('prescription_id');
            $prescription_detail->medicine = $req->input('medicine');
            $prescription_detail->dosage = $req->input('dosage');
            $prescription_detail->rule_of_use = $req->input('rule_of_use');
            $prescription_detail->is_verified = '0';

            $prescription_detail->save();

            if (Auth::user()->status == 'Pharmacy') {
                return redirect(url('pharmacy/prescription/fill-medicine'));
            }
            return redirect(url('doctor/checkup/patient_2_pharmacy'));
        } elseif (strtolower($action) == 'submit') {
            //Lakukan submit resep obat

            $prescription_detail->where('prescription_id', $req->input('prescription_id'))->update(array('is_verified' => '1'));
            $patient_id = DB::table('prescription')->where('id', $req->input('prescription_id'))->value('patient_id');
            $patient_name = DB::table('patient')->where('id', $patient_id)->value('name');

            if (Auth::user()->status == 'Pharmacy') {
                return redirect(url('pharmacy/prescription/fill-amount'));
            }
            return redirect(url('doctor/checkup/patient'))->with('message', 'Pemeriksaan pasien ' . $patient_name . ' telah selesai.');
        } elseif (strtolower($action) == 'cancel') {
            //Lakukan batal resep obat
        } elseif (strtolower(substr($action, 0, 6)) == 'delete') {
            //Lakukan penghapusan obat tertentu

            $pieces = explode("_", $action);

            $id_detail = $pieces[1];

            DB::table('prescription_detail')->where('id', $id_detail)->delete();

            if (Auth::user()->status == 'Pharmacy') {
                return redirect(url('pharmacy/prescription/fill-medicine'));
            }

            return redirect(url('doctor/checkup/patient_2_pharmacy'));
        }
    }

    //Untuk menampilkan form tambah pemeriksaan pasien ke pemeriksaan dokter | lab - Hanya untuk Admin
    //CURRENTLY NOT USED
    public function add() {
        $patient = DB::table('users')->join('patient', 'users.id', '=', 'patient.user_id')->where('users.is_enabled', '=', '1')->get();
        $doctor = DB::table('users')->join('doctor', 'users.id', '=', 'doctor.user_id')->where('users.is_enabled', '=', '1')->get();
        $lab = DB::table('users')->join('lab', 'users.id', '=', 'lab.user_id')->where('users.is_enabled', '=', '1')->get();

        $data = array(
            'patient' => $patient,
            'doctor' => $doctor,
            'action' => NULL,
            'lab' => $lab
        );
        return view('checkup.add-1', $data);
    }

    //Admin
    public function add_1() {
        $patient = DB::table('users')->join('patient', 'users.id', '=', 'patient.user_id')->where('users.is_enabled', '=', '1')->get();

        $data = array(
            'patient' => $patient,
        );

        return view('checkup.add-1', $data);
    }

    public function add_2(Request $request) {
        $patient = $request->input('patient');
        $type = $request->input('checkup_type');

        if ($type == 'Doctor') {
            $to = DB::table('users')->join('doctor', 'users.id', '=', 'doctor.user_id')->where('users.is_enabled', '=', '1')->get();
        } elseif ($type == 'Lab') {
            $to = DB::table('users')->join('lab', 'users.id', '=', 'lab.user_id')->where('users.is_enabled', '=', '1')->get();
        } elseif ($type == 'Pharmacy') {
            $to = DB::table('users')->where('status', 'Pharmacy')->where('is_enabled', '=', '1')->get();
        }

        $data = array(
            'patient' => $patient,
            'checkup_type' => $type,
            'data' => $to
        );
        return view('checkup.add-2', $data);
    }

    //Do something with input param
    public function add_submit(Request $req) {
        $patient_id = $req->input('patient');
        $type = $req->input('type');
        $param = $req->input('to');
        $date = $req->input('date');

        if ($type == 'Doctor') {
            $checkup = new Checkup;

            $checkup->doctor_id = $param;
            $checkup->patient_id = $patient_id;
            $checkup->symtomp = NULL;
            $checkup->result = NULL;
            $checkup->note = NULL;
            $checkup->date = date('Y-m-d', strtotime($date));

            $checkup->save();
        } elseif ($type == 'Lab') {
//            $req->file('photo')->storeAs(('/assets/userfile'), md5($req->input('email')) . '.' . $req->file('photo')->extension());

            $lab_checkup = new Lab_checkup;

            $lab_checkup->checkup_id = '0';
            $lab_checkup->lab_id = $param;
            $lab_checkup->patient_id = $patient_id;
            $lab_checkup->result = NULL;
            $lab_checkup->notes = NULL;
            $lab_checkup->date = date('Y-m-d', strtotime($date));
//            $lab_checkup->photo = 'assets/userfile/patient/lab/' . md5($patient_id) . '.' . $req->file('photo')->extension();

            $lab_checkup->save();
        } else {
            //Insert into pharmacy_header & pharmacy_detail
            $prescription = new Prescription;

            $prescription->checkup_id = NULL;
            $prescription->doctor_id = NULL;
            $prescription->patient_id = $patient_id;
            $prescription->date = date('Y-m-d', strtotime($date));
            $prescription->note = NULL;
            $prescription->amount = NULL;

            $prescription->save();
        }

        return redirect('admin/checkup/add')->with('message', 'Pasien telah ditambahkan ke pemeriksaan');
    }

    //Untuk mencari pasien dari pemeriksaan dokter
    public function all() {
        if (Auth::guest() == TRUE || Auth::user()->status !== 'Patient') {
            return $this->auth();
        }
        return view('checkup.search');
    }

    //Untuk mencari pasien dari pemeriksaan dokter | lab
    public function search() {
        return view('checkup.search');
    }

    //Untuk mencari pasien dari pemeriksaan dokter | lab
    public function search_result(Request $request) {
        $param = $request->input('date');
        $date = date('Y-m-d', strtotime($param));

//        $get_by_date = DB::table('checkup')->join('doctor', 'doctor.id', '=', 'checkup.doctor_id')->join('patient', 'patient.id', '=', 'checkup.patient_id')->where('date', $date)->get();

        $checkup = new Checkup;

        $get_by_date = $checkup::where('date', $date)->get();

        $data = array(
            'form' => 'search',
            'date' => $date,
            'result' => $get_by_date
        );

        return view('checkup.search-result', $data);
    }

    //Untuk melihat pemeriksaan mendatang
    public function future() {
        $checkup = new Checkup;
        $date = date('Y-m-d');
        $get_future = $checkup::where('date', '>=', $date)->get();

        $data = array(
            'form' => 'future',
            'result' => $get_future
        );

        return view('checkup.search-result', $data);
    }

    //Untuk melihat pemeriksaan terdahulu
    public function history() {
        $checkup = new Checkup;
        $date = date('Y-m-d');
        $get_future = $checkup::where('date', '<', $date)->get();

        $data = array(
            'form' => 'future',
            'result' => $get_future
        );

        return view('checkup.search-result', $data);
    }

    //Untuk melihat detail pemeriksaan
    public function detail($id) {
        $data['checkup'] = DB::table('checkup')->where('id', $id)->get();
        foreach ($data['checkup'] as $r_pres) {
            $patient_id = $r_pres->patient_id;
            $doctor_id = $r_pres->doctor_id;
        }
        $data['patient'] = DB::table('patient')->where('id', $patient_id)->get();
        $data['doctor'] = DB::table('doctor')->where('id', $doctor_id)->get();
        //Check where is referral doctor goes to. Pharmacy | Lab
        $check_pharmacy = DB::table('prescription')->where('checkup_id', $id)->count();
        $check_lab = DB::table('lab_checkup')->where('checkup_id', $id)->count();
        if ($check_pharmacy > 0) {
            $data['prescription'] = DB::table('prescription')->where('checkup_id', $id)->get();
            foreach ($data['prescription'] as $r_pres_2) {
                $prescription_id = $r_pres_2->id;
            }
            $data['prescription_detail'] = DB::table('prescription_detail')->where('prescription_id', $prescription_id)->get();

            return view('prescription.detail-prescription', $data);
        } elseif ($check_lab > 0) {
            $data['lab'] = DB::table('lab_checkup')->where('checkup_id', $id)->get();

            return view('lab_checkup.detail-lab', $data);
        } else {
            return Redirect::back();
        }
    }

    public function categoryDropDownData() {
        $cat_id = Input::get('category');

        $subcategories = DB::table('users')->where('status', '=', $cat_id)->get();

        return Response::json($subcategories);
    }

}
