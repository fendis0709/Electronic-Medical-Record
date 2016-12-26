<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class User extends Controller {

    function __construct() {
        /*
        if (!Auth::check()) {
            return view('auth.login');
        } elseif (Auth::user()->status == 'Admin') {
            return redirect('admin');
        } elseif (Auth::user()->status == 'Doctor') {
            return redirect('doctor');
        } elseif (Auth::user()->status == 'Lab') {
            return redirect('lab');
        } elseif (Auth::user()->status == 'Pharmacy') {
            return redirect('pharmacy');
        } elseif (Auth::user()->status == 'Patient') {
            return redirect('patient');
        }
         */
    }

    public function login() {
        if (!Auth::check()) {
            return view('auth.login');
        } elseif (Auth::user()->status == 'Admin') {
            return redirect('admin');
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

    public function register() {
        if (Auth::guest()) {
            return view('auth.register');
        } elseif (Auth::user()->status == 'Admin') {
            return redirect('admin');
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
    
    public function register_2(){
        return var_dump(Auth::check()).'abd';
    }

}
