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
Route::get('/admin', 'Admin@home');
Route::get('/admin/home', 'Admin@home');
Route::get('/admin/profile', 'Admin@profile');
Route::get('/admin/profile/edit', 'Admin@profile_edit');
Route::post('/admin/profile/edit', 'Admin@profile_edit_submit');
Route::get('/admin/profile/edit/password', 'Admin@password_edit');
Route::post('/admin/profile/edit/password', 'Admin@password_edit_submit');
//Menu Pemeriksaan
Route::get('/admin/checkup/add', 'Checkup@add_1');
Route::post('/admin/checkup/add_submit', 'Checkup@add_submit');
Route::post('/admin/checkup/add_2', 'Checkup@add_2');
Route::get('/admin/checkup/search', 'Checkup@search');
Route::post('/admin/checkup/search', 'Checkup@search_result');
//Route::get('/admin/checkup/search_result?{term}', ['as' => 'date', 'uses' => 'Checkup@search']);
Route::get('/admin/checkup/future', 'Checkup@future');
Route::get('/admin/checkup/history', 'Checkup@history');
//Menu Dokter
Route::get('/admin/doctor/add', 'Doctor@doctor_add');
Route::post('/admin/doctor/add', 'Doctor@doctor_add_submit');
Route::get('/admin/doctor/manage', 'Doctor@manage');
Route::get('/admin/doctor/detail/{id}', 'Doctor@profile');
Route::get('/admin/doctor/edit/{id}', 'Doctor@profile_edit');
Route::post('/admin/doctor/edit', 'Doctor@profile_edit_submit');
Route::get('/admin/doctor/delete/{id}', 'Doctor@delete');
//Menu Laboratorium
Route::get('/admin/lab/add', 'Lab@lab_add');
Route::post('/admin/lab/add', 'Lab@lab_add_submit');
Route::get('/admin/lab/manage', 'Lab@manage');
Route::get('/admin/lab/detail/{id}', 'Lab@profile');
Route::get('/admin/lab/edit/{id}', 'Lab@profile_edit');
Route::post('/admin/lab/edit', 'Lab@profile_edit_submit');
Route::get('/admin/lab/delete/{id}', 'Lab@delete');
//Menu Farmasi
Route::get('/admin/pharmacy/add', 'Pharmacy@pharmacy_add');
Route::post('/admin/pharmacy/add', 'Pharmacy@pharmacy_add_submit');
Route::get('/admin/pharmacy/manage', 'Pharmacy@manage');
Route::get('/admin/pharmacy/detail/{id}', 'Pharmacy@profile');
Route::get('/admin/pharmacy/edit/{id}', 'Pharmacy@profile_edit');
Route::post('/admin/pharmacy/edit', 'Pharmacy@profile_edit_submit');
Route::get('/admin/pharmacy/delete/{id}', 'Pharmacy@delete');
//Menu Pasien
Route::get('/admin/patient/add', 'Patient@patient_add');
Route::post('/admin/patient/add', 'Patient@patient_add_submit');
Route::get('/admin/patient/manage', 'Patient@manage');
Route::get('/admin/patient/detail/{id}', 'Patient@profile');
Route::get('/admin/patient/edit/{id}', 'Patient@profile_edit');
Route::post('/admin/patient/edit', 'Patient@profile_edit_submit');
Route::get('/admin/patient/delete/{id}', 'Patient@delete');

/*
 * Route for Doctor Controller
 */
Route::get('/doctor', 'Doctor@home');
Route::get('/doctor/home', 'Doctor@home');
Route::get('/doctor/profile', 'Doctor@profile');
Route::get('/doctor/profile/edit', 'Doctor@profile_edit');
Route::post('/doctor/profile/edit', 'Doctor@profile_edit_submit');
Route::get('/doctor/profile/edit/password', 'Doctor@password_edit');
Route::post('/doctor/profile/edit/password', 'Doctor@password_edit_submit');
//Menu pemeriksaan pasien
Route::get('/doctor/checkup/patient', 'Checkup@step_1');
Route::post('/doctor/checkup/step_1_submit', 'Checkup@step_1_submit');
Route::get('/doctor/checkup/patient_2_lab', 'Checkup@step_2_lab');
Route::post('/doctor/checkup/step_2_lab_submit', 'Checkup@step_2_lab_submit');
Route::get('/doctor/checkup/patient_2_pharmacy', 'Checkup@step_2_pharmacy');
Route::post('/doctor/checkup/step_2_pharmacy_submit', 'Checkup@step_2_pharmacy_submit');
Route::get('/doctor/checkup/patient_done', 'Checkup@step_2_pharmacy_submit');
//Menu pasien
Route::get('/doctor/patient/my-patient', 'Doctor@my_patient');



Route::post('/doctor/checkup/step2_refer_submit', 'Checkup@step_2_submit');
Route::get('/doctor/checkup/step3_lab', 'Checkup@step_3_1');
Route::get('/doctor/checkup/step3_pharmacy', 'Checkup@step_3_2');
Route::get('/doctor/checkup/category-dropdown', 'Checkup@categoryDropDownData');
Route::get('/doctor/checkup/future', 'Checkup@future');
Route::get('/doctor/checkup/history', 'Checkup@history');
Route::get('/doctor/checkup/search', 'Checkup@search');
Route::post('/doctor/checkup/search', 'Checkup@search_result');
Route::get('/doctor/checkup/detail/{id}', 'Checkup@detail');

/*
 * Route for Laboratorium Controller
 */
Route::get('/lab', 'Lab@home');
Route::get('/lab/home', 'Lab@home');
Route::get('/lab/profile', 'Lab@profile');
Route::get('/lab/profile/edit', 'Lab@profile_edit');
Route::post('/lab/profile/edit', 'Lab@profile_edit_submit');
Route::get('/lab/profile/edit/password', 'Lab@password_edit');
Route::post('/lab/profile/edit/password', 'Lab@password_edit_submit');
Route::get('/lab/checkup/add', 'Lab_checkup@add');
Route::post('/lab/checkup/add', 'Lab_checkup@add_submit');

Route::get('/lab/checkup/search', 'Lab_checkup@search');
Route::post('/lab/checkup/search', 'Lab_checkup@search_result');
Route::get('/lab/checkup/future', 'Lab_checkup@future');
Route::get('/lab/checkup/history', 'Lab_checkup@history');
Route::get('/lab/checkup/detail/{id}', 'Lab_checkup@detail');
/*
  Route::get('/lab/checkup/future', 'Checkup@future');
  Route::get('/lab/checkup/history', 'Checkup@history');
  Route::get('/lab/checkup/search', 'Checkup@search');
  Route::get('/lab/checkup/search-result', 'Checkup@search_result');

  /*
 * Route for Pharmacy Controller
 */
Route::get('/pharmacy', 'Pharmacy@home');
Route::get('/pharmacy/home', 'Pharmacy@home');
Route::get('/pharmacy/profile', 'Pharmacy@profile');
Route::get('/pharmacy/profile/edit', 'Pharmacy@profile_edit');
Route::post('/pharmacy/profile/edit', 'Pharmacy@profile_edit_submit');
Route::get('/pharmacy/profile/edit/password', 'Pharmacy@password_edit');
Route::post('/pharmacy/profile/edit/password', 'Pharmacy@password_edit_submit');
//Menu pemeriksaan
Route::get('/pharmacy/prescription/add', 'Prescription@add');
Route::post('/pharmacy/prescription/step_1_submit', 'Prescription@add_submit');
Route::get('/pharmacy/prescription/fill-medicine', 'Prescription@fill_medicine');
Route::get('/pharmacy/prescription/fill-amount', 'Prescription@fill_amount');
Route::post('/pharmacy/prescription/fill-amount-submit', 'Prescription@fill_amount_submit');
Route::get('/pharmacy/prescription/confirm', 'Prescription@confirm');
Route::get('/pharmacy/prescription/search', 'Prescription@search');
Route::post('/pharmacy/prescription/search', 'Prescription@search_result');
Route::get('/pharmacy/prescription/history', 'Prescription@history');
Route::get('/pharmacy/prescription/future', 'Prescription@future');
Route::get('/pharmacy/prescription/detail/{id}', 'Prescription@detail');

/*
 * Route for Patient Controller
 */
Route::get('/patient', 'Patient@home');
Route::get('/patient/home', 'Patient@home');
Route::get('/patient/profile', 'Patient@profile');
Route::get('/patient/profile/edit', 'Patient@profile_edit');
Route::get('/patient/profile/edit/password', 'Patient@password_edit');
Route::post('/patient/profile/edit/password', 'Patient@password_edit_submit');
//Menu Pemeriksaan
Route::get('/patient/checkup/all', 'Checkup@all');
Route::get('/patient/checkup/future', 'Checkup@future');
Route::get('/patient/checkup/history', 'Checkup@history');
Route::get('/patient/checkup/search', 'Checkup@search');
Route::post('/patient/checkup/search', 'Checkup@search_result');
Route::get('/patient/checkup/detail/{id}', 'Checkup@detail');
//Menu Lab
Route::get('/patient/lab/search', 'Lab_checkup@search');
Route::post('/patient/lab/search', 'Lab_checkup@search_result');
Route::get('/patient/lab/future', 'Lab_checkup@future');
Route::get('/patient/lab/history', 'Lab_checkup@history');
Route::get('/patient/lab/detail/{id}', 'Lab_checkup@detail');
//Menu Resep
Route::get('/patient/prescription/search', 'Prescription@search');
Route::post('/patient/prescription/search', 'Prescription@search_result');
Route::get('/patient/prescription/detail/{id}', 'Prescription@detail');
Route::get('/patient/prescription/history', 'Prescription@history');
Route::get('/patient/prescription/future', 'Prescription@future');
Route::get('/patient/prescription/all', 'Prescription@all');
