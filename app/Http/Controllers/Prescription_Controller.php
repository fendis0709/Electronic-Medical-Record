<?php

namespace App\Http\Controllers;

use App\Prescription;
use App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Prescription_Controller extends Controller {

    public function all() {
        $patient_id = DB::table('patient')->where('user_id', Auth::user()->id)->value('id');

        $presctiption = new Prescription;
        $data['prescription'] = $presctiption::where('patient_id', $patient_id)->get();

        return view('prescription.all', $data);
    }

    public function search() {
        return view('prescription.search');
    }

    //Untuk mencari pasien dari pemeriksaan dokter | lab
    public function search_result(Request $request) {
        $param = $request->input('date');
        $date = date('Y-m-d', strtotime($param));

        $checkup = new Prescription;

        $get_by_date = $checkup::where('date', $date)->get();

        $data = array(
            'form' => 'search',
            'date' => $date,
            'result' => $get_by_date
        );

        return view('prescription.search-result', $data);
    }

    public function history() {
        $checkup = new Prescription;
        $date = date('Y-m-d');
        $get_future = $checkup::where('date', '<', $date)->get();

        $data = array(
            'form' => 'future',
            'result' => $get_future
        );

        return view('prescription.search-result', $data);
    }

    public function future() {
        $checkup = new Prescription;
        $date = date('Y-m-d');
        $get_future = $checkup::where('date', '>=', $date)->get();

        $data = array(
            'form' => 'future',
            'result' => $get_future
        );

        return view('prescription.search-result', $data);
    }

    //Menu untuk farmasi memilih resep pasien
    public function add() {
        $data['patient_id'] = DB::table('prescription')->where('date', date('Y-m-d'))->where('amount', '=', NULL)->value('patient_id');
        $data['patient'] = DB::table('patient')->where('id', $data['patient_id'])->get();

        return view('prescription.patient-add', $data);
    }

    public function add_submit(Request $req) {
        $patient_id = $req->input('patient');
        $prescription_id = DB::table('prescription')->where('patient_id', $patient_id)->where('date', date('Y-m-d'))->where('amount', NULL)->value('id');

        Session::set('prescription_id', $prescription_id);

        /*
         * Count is exist on table prescription_detail
         * if exist, pharmacy only insert price of medicine
         * otherwise, insert medicine + price
         */
        $is_filled_doctor = DB::table('prescription_detail')->where('prescription_id', $prescription_id)->count();

        if ($is_filled_doctor == 0 || $is_filled_doctor == NULL) {
            return redirect(url('pharmacy/prescription/fill-medicine'));
        }
        return redirect(url('pharmacy/prescription/fill-amount'));
    }

    public function fill_medicine() {
        $prescription_id = Session::get('prescription_id');
        $data['prescription'] = DB::table('prescription')->where('id', $prescription_id)->get();
        foreach ($data['prescription'] as $r_prescription) {
            $patient_id = $r_prescription->patient_id;
            $checkup_id = $r_prescription->checkup_id;
        }
        $data['prescription_detail'] = DB::table('prescription_detail')->where('prescription_id', $prescription_id)->get();
        $data['patient'] = DB::table('patient')->where('id', $patient_id)->get();
        $data['checkup'] = NULL;
        $data['doctor'] = NULL;
        $data['prescription_id'] = $prescription_id;

        if ($checkup_id == NULL || $checkup_id == '0') {
            $data['checkup'] = DB::table('checkup')->where('id', $checkup_id)->get();
            $doctor_id = DB::table('checkup')->where('id', $checkup_id)->value('doctor_id');
            $data['doctor'] = DB::table('doctor')->where('id', $doctor_id)->get();
        }

        return view('prescription.fill-medicine', $data);
    }

    public function fill_amount() {
        $prescription_id = Session::get('prescription_id');
        $data['prescription_id'] = $prescription_id;
        $data['prescription'] = DB::table('prescription')->where('id', $prescription_id)->get();
        foreach ($data['prescription'] as $r_prescription) {
            $patient_id = $r_prescription->patient_id;
            $checkup_id = $r_prescription->checkup_id;
        }
        $data['patient'] = DB::table('patient')->where('id', $patient_id)->get();
        $data['checkup'] = DB::table('checkup')->where('id', $checkup_id)->get();
        $data['prescription_detail'] = DB::table('prescription_detail')->where('prescription_id', $prescription_id)->where('is_verified', '1')->get();
        $doctor_id = DB::table('checkup')->where('id', $checkup_id)->value('doctor_id');
        $data['doctor'] = DB::table('doctor')->where('id', $doctor_id)->value('name');
        return view('prescription.fill-amount', $data);
    }

    public function fill_amount_submit(Request $req) {
        $amount = $req->input('amount');
        $notes = $req->input('notes');
        $action = $req->input('action');
        $prescription_id = $req->input('prescription_id');
        if (strtolower($action) == 'submit') {
            DB::table('prescription')->where('id', $prescription_id)->update(array(
                'amount' => $amount,
                'note' => $notes
            ));

            Session::forget('prescription_id');

            return redirect('pharmacy/prescription/add')->with('message', 'Resep obat pasien telah selesai diproses.');
        } else {
            //Do when pharmacy click cancel
        }
    }

    public function detail($id) {
        $data['prescription'] = DB::table('prescription')->where('id', $id)->get();
        foreach ($data['prescription'] as $r_pres) {
            $patient_id = $r_pres->patient_id;
            $doctor_id = $r_pres->doctor_id;
            $checkup_id = $r_pres->checkup_id;
        }
        $data['patient'] = DB::table('patient')->where('id', $patient_id)->get();
        $data['doctor'] = DB::table('doctor')->where('id', $doctor_id)->get();
        $data['checkup'] = DB::table('checkup')->where('id', $checkup_id)->get();
        $data['prescription_detail'] = DB::table('prescription_detail')->where('prescription_id', $id)->get();

        return view('prescription.detail-prescription', $data);
    }

}
