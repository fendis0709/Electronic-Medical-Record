<?php

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */

use App\User;
use Illuminate\Support\Facades\Input;

/*
 * Route for Auth Account
 */
Auth::routes();
//Route::get('/home', 'HomeController@index');
Route::get('/', 'User@login');
//Route::get('/login', 'User@login');
Route::get('/login', ['as' => 'login', 'uses' => 'User@login']);
Route::get('/home', 'User@login');
Route::get('/register', 'User@register');
Route::get('/coba', function() {
    return password_hash('pasien', PASSWORD_DEFAULT);
});

Route::get('/test', function() {
    $hasil = DB::table('users')->where('id', '100')->get();
    if (count($hasil) == 0) {
        return 'Kosong';
    } else {
        return $hasil;
    }
});

/*
 * Route for Admin Controller
 */
Route::get('/admin', 'Admin_Controller@home');
Route::get('/admin/home', 'Admin_Controller@home');
Route::get('/admin/profile', 'Admin_Controller@profile');
Route::get('/admin/profile/edit', 'Admin_Controller@profile_edit');
Route::post('/admin/profile/edit', 'Admin_Controller@profile_edit_submit');
Route::get('/admin/profile/edit/password', 'Admin_Controller@password_edit');
Route::post('/admin/profile/edit/password', 'Admin_Controller@password_edit_submit');
//Menu Pemeriksaan
Route::get('/admin/checkup/add', 'Checkup_Controller@add_1');
Route::post('/admin/checkup/add_submit', 'Checkup_Controller@add_submit');
Route::post('/admin/checkup/add_2', 'Checkup_Controller@add_2');
Route::get('/admin/checkup/search', 'Checkup_Controller@search');
Route::post('/admin/checkup/search', 'Checkup_Controller@search_result');
//Route::get('/admin/checkup/search_result?{term}', ['as' => 'date', 'uses' => 'Checkup_Controller@search']);
Route::get('/admin/checkup/future', 'Checkup_Controller@future');
Route::get('/admin/checkup/history', 'Checkup_Controller@history');
//Menu Dokter
Route::get('/admin/doctor/add', 'Doctor_Controller@doctor_add');
Route::post('/admin/doctor/add', 'Doctor_Controller@doctor_add_submit');
Route::get('/admin/doctor/manage', 'Doctor_Controller@manage');
Route::get('/admin/doctor/detail/{id}', 'Doctor_Controller@profile');
Route::get('/admin/doctor/edit/{id}', 'Doctor_Controller@profile_edit');
Route::post('/admin/doctor/edit', 'Doctor_Controller@profile_edit_submit');
Route::get('/admin/doctor/delete/{id}', 'Doctor_Controller@delete');
//Menu Laboratorium
Route::get('/admin/lab/add', 'Lab_Controller@lab_add');
Route::post('/admin/lab/add', 'Lab_Controller@lab_add_submit');
Route::get('/admin/lab/manage', 'Lab_Controller@manage');
Route::get('/admin/lab/detail/{id}', 'Lab_Controller@profile');
Route::get('/admin/lab/edit/{id}', 'Lab_Controller@profile_edit');
Route::post('/admin/lab/edit', 'Lab_Controller@profile_edit_submit');
Route::get('/admin/lab/delete/{id}', 'Lab_Controller@delete');
//Menu Farmasi
Route::get('/admin/pharmacy/add', 'Pharmacy_Controller@pharmacy_add');
Route::post('/admin/pharmacy/add', 'Pharmacy_Controller@pharmacy_add_submit');
Route::get('/admin/pharmacy/manage', 'Pharmacy_Controller@manage');
Route::get('/admin/pharmacy/detail/{id}', 'Pharmacy_Controller@profile');
Route::get('/admin/pharmacy/edit/{id}', 'Pharmacy_Controller@profile_edit');
Route::post('/admin/pharmacy/edit', 'Pharmacy_Controller@profile_edit_submit');
Route::get('/admin/pharmacy/delete/{id}', 'Pharmacy_Controller@delete');
//Menu Pasien
Route::get('/admin/patient/add', 'Patient_Controller@patient_add');
Route::post('/admin/patient/add', 'Patient_Controller@patient_add_submit');
Route::get('/admin/patient/manage', 'Patient_Controller@manage');
Route::get('/admin/patient/detail/{id}', 'Patient_Controller@profile');
Route::get('/admin/patient/edit/{id}', 'Patient_Controller@profile_edit');
Route::post('/admin/patient/edit', 'Patient_Controller@profile_edit_submit');
Route::get('/admin/patient/delete/{id}', 'Patient_Controller@delete');

/*
 * Route for Doctor Controller
 */
Route::get('/doctor', 'Doctor_Controller@home');
Route::get('/doctor/home', 'Doctor_Controller@home');
Route::get('/doctor/profile', 'Doctor_Controller@profile');
Route::get('/doctor/profile/edit', 'Doctor_Controller@profile_edit');
Route::post('/doctor/profile/edit', 'Doctor_Controller@profile_edit_submit');
Route::get('/doctor/profile/edit/password', 'Doctor_Controller@password_edit');
Route::post('/doctor/profile/edit/password', 'Doctor_Controller@password_edit_submit');
//Menu pemeriksaan pasien
Route::get('/doctor/checkup/patient', 'Checkup_Controller@step_1');
Route::post('/doctor/checkup/step_1_submit', 'Checkup_Controller@step_1_submit');
Route::get('/doctor/checkup/patient_2_lab', 'Checkup_Controller@step_2_lab');
Route::post('/doctor/checkup/step_2_lab_submit', 'Checkup_Controller@step_2_lab_submit');
Route::get('/doctor/checkup/patient_2_pharmacy', 'Checkup_Controller@step_2_pharmacy');
Route::post('/doctor/checkup/step_2_pharmacy_submit', 'Checkup_Controller@step_2_pharmacy_submit');
Route::get('/doctor/checkup/patient_done', 'Checkup_Controller@step_2_pharmacy_submit');
//Menu pasien
Route::get('/doctor/patient/my-patient', 'Doctor_Controller@my_patient');



Route::post('/doctor/checkup/step2_refer_submit', 'Checkup_Controller@step_2_submit');
Route::get('/doctor/checkup/step3_lab', 'Checkup_Controller@step_3_1');
Route::get('/doctor/checkup/step3_pharmacy', 'Checkup_Controller@step_3_2');
Route::get('/doctor/checkup/category-dropdown', 'Checkup_Controller@categoryDropDownData');
Route::get('/doctor/checkup/future', 'Checkup_Controller@future');
Route::get('/doctor/checkup/history', 'Checkup_Controller@history');
Route::get('/doctor/checkup/search', 'Checkup_Controller@search');
Route::post('/doctor/checkup/search', 'Checkup_Controller@search_result');
Route::get('/doctor/checkup/detail/{id}', 'Checkup_Controller@detail');

/*
 * Route for Laboratorium Controller
 */
Route::get('/lab', 'Lab_Controller@home');
Route::get('/lab/home', 'Lab_Controller@home');
Route::get('/lab/profile', 'Lab_Controller@profile');
Route::get('/lab/profile/edit', 'Lab_Controller@profile_edit');
Route::post('/lab/profile/edit', 'Lab_Controller@profile_edit_submit');
Route::get('/lab/profile/edit/password', 'Lab_Controller@password_edit');
Route::post('/lab/profile/edit/password', 'Lab_Controller@password_edit_submit');
Route::get('/lab/checkup/add', 'Lab_checkup@add');
Route::post('/lab/checkup/add', 'Lab_checkup@add_submit');

Route::get('/lab/checkup/search', 'Lab_checkup@search');
Route::post('/lab/checkup/search', 'Lab_checkup@search_result');
Route::get('/lab/checkup/future', 'Lab_checkup@future');
Route::get('/lab/checkup/history', 'Lab_checkup@history');
Route::get('/lab/checkup/detail/{id}', 'Lab_checkup@detail');
/*
  Route::get('/lab/checkup/future', 'Checkup_Controller@future');
  Route::get('/lab/checkup/history', 'Checkup_Controller@history');
  Route::get('/lab/checkup/search', 'Checkup_Controller@search');
  Route::get('/lab/checkup/search-result', 'Checkup_Controller@search_result');

  /*
 * Route for Pharmacy Controller
 */
Route::get('/pharmacy', 'Pharmacy_Controller@home');
Route::get('/pharmacy/home', 'Pharmacy_Controller@home');
Route::get('/pharmacy/profile', 'Pharmacy_Controller@profile');
Route::get('/pharmacy/profile/edit', 'Pharmacy_Controller@profile_edit');
Route::post('/pharmacy/profile/edit', 'Pharmacy_Controller@profile_edit_submit');
Route::get('/pharmacy/profile/edit/password', 'Pharmacy_Controller@password_edit');
Route::post('/pharmacy/profile/edit/password', 'Pharmacy_Controller@password_edit_submit');
//Menu pemeriksaan
Route::get('/pharmacy/prescription/add', 'Prescription_Controller@add');
Route::post('/pharmacy/prescription/step_1_submit', 'Prescription_Controller@add_submit');
Route::get('/pharmacy/prescription/fill-medicine', 'Prescription_Controller@fill_medicine');
Route::get('/pharmacy/prescription/fill-amount', 'Prescription_Controller@fill_amount');
Route::post('/pharmacy/prescription/fill-amount-submit', 'Prescription_Controller@fill_amount_submit');
Route::get('/pharmacy/prescription/confirm', 'Prescription_Controller@confirm');
Route::get('/pharmacy/prescription/search', 'Prescription_Controller@search');
Route::post('/pharmacy/prescription/search', 'Prescription_Controller@search_result');
Route::get('/pharmacy/prescription/history', 'Prescription_Controller@history');
Route::get('/pharmacy/prescription/future', 'Prescription_Controller@future');
Route::get('/pharmacy/prescription/detail/{id}', 'Prescription_Controller@detail');

/*
 * Route for Patient Controller
 */
Route::get('/patient', 'Patient_Controller@home');
Route::get('/patient/home', 'Patient_Controller@home');
Route::get('/patient/profile', 'Patient_Controller@profile');
Route::get('/patient/profile/edit', 'Patient_Controller@profile_edit');
Route::get('/patient/profile/edit/password', 'Patient_Controller@password_edit');
Route::post('/patient/profile/edit/password', 'Patient_Controller@password_edit_submit');
//Menu Pemeriksaan
Route::get('/patient/checkup/all', 'Checkup_Controller@all');
Route::get('/patient/checkup/future', 'Checkup_Controller@future');
Route::get('/patient/checkup/history', 'Checkup_Controller@history');
Route::get('/patient/checkup/search', 'Checkup_Controller@search');
Route::post('/patient/checkup/search', 'Checkup_Controller@search_result');
Route::get('/patient/checkup/detail/{id}', 'Checkup_Controller@detail');
//Menu Lab
Route::get('/patient/lab/search', 'Lab_checkup@search');
Route::post('/patient/lab/search', 'Lab_checkup@search_result');
Route::get('/patient/lab/future', 'Lab_checkup@future');
Route::get('/patient/lab/history', 'Lab_checkup@history');
Route::get('/patient/lab/detail/{id}', 'Lab_checkup@detail');
//Menu Resep
Route::get('/patient/prescription/search', 'Prescription_Controller@search');
Route::post('/patient/prescription/search', 'Prescription_Controller@search_result');
Route::get('/patient/prescription/detail/{id}', 'Prescription_Controller@detail');
Route::get('/patient/prescription/history', 'Prescription_Controller@history');
Route::get('/patient/prescription/future', 'Prescription_Controller@future');
Route::get('/patient/prescription/all', 'Prescription_Controller@all');
